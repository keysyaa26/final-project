<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/qr_code.php';
require_once __DIR__ . '/../src/invoices.php';

require 'midtrans_config.php';

use Midtrans\Notification;

try {
    $json = file_get_contents('php://input');
    if (empty($json)) {
        throw new Exception("Payload kosong. Midtrans tidak mengirimkan data.");
    }

    // Log payload mentah
    file_put_contents(
        __DIR__ . '/../midtrans/midtrans_callback.log',
        date('Y-m-d H:i:s') . ' ' . $json . "\n",
        FILE_APPEND
    );

    $notif = new Notification();

    $transaction = $notif->transaction_status;
    $order_id = $notif->order_id;
    $price = $notif->gross_amount;
    $purchase_date = $notif->transaction_time;
    // $payment_url = $notif->custom_field3 ?? 'null';


    // Pastikan order_id diterima
    if (!$order_id) {
        throw new Exception("Order ID tidak ditemukan dalam payload Midtrans.");
    }

    // Decode custom_field
    $custom_field1 = json_decode($notif->custom_field1, true);
    $custom_field2 = json_decode($notif->custom_field2, true);

    file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Decoded custom_field1: " . print_r($custom_field1, true) . "\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Decoded custom_field2: " . print_r($custom_field2, true) . "\n", FILE_APPEND);

    if (!$custom_field1 || !$custom_field2) {
        throw new Exception("Custom fields tidak ditemukan atau formatnya tidak valid.");
    }
    
    $name = $custom_field1['extra_field1'] ?? null;
    $email = $custom_field1['extra_field2'] ?? null;
    $phone = $custom_field1['extra_field3'] ?? null;
    $ticket_id = $custom_field2['extra_field4'] ?? null;
    $event_id = $custom_field2['extra_field5'] ?? null;
    $title = $custom_field2['extra_field6'] ?? null;

    if ($transaction === "pending") {

        // Validasi nama dan email untuk attendee yang sama
        $check_attendee_stmt = $pdo->prepare("SELECT * FROM attendee WHERE name = :name AND email = :email");
        $check_attendee_stmt->execute(['name' => $name, 'email' => $email]);
        $attendee = $check_attendee_stmt->fetch(PDO::FETCH_ASSOC);

        if ($attendee) {
            $attendee_id = $attendee['attendee_ID'];
        } else {
            // Tambahkan peserta baru ke tabel attendee
            $insert_attendee_stmt = $pdo->prepare("INSERT INTO attendee (name, email, phone) VALUES (:name, :email, :phone)");
            $insert_attendee_stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);
            $attendee_id = $pdo->lastInsertId(); // Ambil ID peserta yang baru ditambahkan
        }

        // Simpan ke tabel event_ticket_assignment
        $insert_ticket_stmt = $pdo->prepare(
            "INSERT INTO event_ticket_assignment 
            (ticket_ID, order_ID, attendee_ID, event_ID, price, purchase_date, transaction_status, QR_Code, attendance_status) 
            VALUES (:ticket_id, :order_id, :attendee_id, :event_id, :price, :purchase_date, :transaction_status, :qr_code, :attendance_status)"
        );
        $insert_ticket_stmt->execute([
            'ticket_id' => $ticket_id,
            'order_id' => $order_id,
            'attendee_id' => $attendee_id,
            'event_id' => $event_id,
            'price' => $price,
            'purchase_date' => $purchase_date,
            'transaction_status' => 'Pending',
            'qr_code' => null,
            'attendance_status' => 'Absen'
        ]);

        // Generate PDF Invoice
        $invoiceData = [
            'order_id' => $order_id,
            'transaction_date' => $purchase_date,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'title' => $title,
            'subtotal' => $price,
            'payment_url' => $payment_url
        ];

        // Log sebelum mengirim invoice
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Generating invoice for Order ID: $order_id\n", FILE_APPEND);

        // Kirim invoice dengan opsi "Bayar Sekarang"
        generate_and_send_invoice($order_id, $email, $invoiceData, true);

        // Log pembayaran tertunda
        file_put_contents(
            __DIR__ . '/../midtrans/debug_sql.log',
            date('Y-m-d H:i:s') . " Payment pending for Order ID: $order_id. Payment URL: $payment_url\n",
            FILE_APPEND
        );        

        // Log setelah mengirim invoice
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Invoice sent to: $email\n", FILE_APPEND);
    } elseif (in_array($transaction, ["settlement", "capture"])) {
        // Generate QR Code
        $qr_code_filename = "qr_{$event_id}_{$attendee_id}.png";
        $qr_code_path = __DIR__ . "/../uploads/qr_code/$qr_code_filename";
        generateQRCode($ticket_id, $qr_code_path);

        // Send Email with QR Code
        sendQRCode($email, $qr_code_path, $title);

        // Log proses QR dan email
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " QR Code generated: $qr_code_path\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Email sent to: $email with QR Code\n", FILE_APPEND);

        // Update status transaksi dan QR Code di database
        $update_ticket_stmt = $pdo->prepare(
            "UPDATE event_ticket_assignment 
            SET transaction_status = 'Success', purchase_date = :purchase_date, QR_Code = :qr_code 
            WHERE order_ID = :order_id"
        );

        $update_ticket_stmt->execute([
            'order_id' => $order_id,
            'purchase_date' => $purchase_date,
            'qr_code' => $qr_code_filename,
        ]);
        
        // Generate PDF Invoice
        $invoiceData = [
            'order_id' => $order_id,
            'transaction_date' => $purchase_date,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'title' => $title,
            'subtotal' => $price
        ];

        // Log sebelum mengirim invoice
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Generating invoice for Order ID: $order_id\n", FILE_APPEND);

        // Kirim invoice tanpa opsi "Bayar Sekarang"
        generate_and_send_invoice($order_id, $email, $invoiceData, false);

        // Log setelah mengirim invoice
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Invoice sent to: $email\n", FILE_APPEND);
    } elseif (in_array($transaction, ['deny', 'cancel', 'expire', 'failure'])) {
        // Hapus data dari event_ticket_assignment dan attendee
        $delete_ticket_stmt = $pdo->prepare("DELETE FROM event_ticket_assignment WHERE order_ID = :order_id");
        $delete_ticket_stmt->execute(['order_id' => $order_id]);

        // Hapus dari attendee jika tidak ada tiket terkait
        $check_related_tickets_stmt = $pdo->prepare("SELECT COUNT(*) FROM event_ticket_assignment WHERE attendee_ID = (SELECT attendee_ID FROM event_ticket_assignment WHERE order_ID = :order_id)");
        $check_related_tickets_stmt->execute(['order_id' => $order_id]);
        $related_tickets_count = $check_related_tickets_stmt->fetchColumn();

        if ($related_tickets_count == 0) {
            $delete_attendee_stmt = $pdo->prepare("DELETE FROM attendee WHERE attendee_ID = (SELECT attendee_ID FROM event_ticket_assignment WHERE order_ID = :order_id)");
            $delete_attendee_stmt->execute(['order_id' => $order_id]);
        }
    }

    error_log("Midtrans notification processed: " . json_encode($notif));
} catch (Exception $e) {
    error_log("Error processing Midtrans callback: " . $e->getMessage());
    file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . $e->getMessage(), FILE_APPEND);
}
?>
