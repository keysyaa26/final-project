<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/qr_code.php';
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

    // Pastikan `order_id` diterima
    if (!$order_id) {
        throw new Exception("Order ID tidak ditemukan dalam payload Midtrans.");
    }

    if ($transaction == 'capture' || $transaction == 'settlement') {
        // Update status transaksi di database
        $update_stmt = $pdo->prepare("
            UPDATE event_ticket_assignment 
            SET transaction_status = 'Paid'
            WHERE order_id = :order_id
        ");
        $update_stmt->execute(['order_id' => $order_id]);
        
        // Kirim email
        $email_stmt = $pdo->prepare("SELECT a.email, e.QR_Code, ev.title FROM event_ticket_assignment e 
                                     JOIN attendee a ON e.attendee_ID = a.attendee_ID 
                                     JOIN events ev ON e.event_ID = ev.event_ID 
                                     WHERE e.order_id = :order_id");
        $email_stmt->execute(['order_id' => $notif->fraud_status]);
        $ticket_data = $email_stmt->fetch(PDO::FETCH_ASSOC);

        if ($ticket_data) {
            $qrCodePath = "../uploads/qr_code/" . $ticket_data['QR_Code'];
            sendEmail($ticket_data['email'], $qrCodePath, $ticket_data['title']);
        }
    } elseif ($transaction === 'pending') {
        // Update status transaksi ke 'Pending'
        $update_stmt = $pdo->prepare("
            UPDATE event_ticket_assignment 
            SET transaction_status = 'Pending'
            WHERE order_id = :order_id
        ");
        $update_stmt->execute(['order_id' => $order_id]);
    }
    error_log("Midtrans notification processed: " . json_encode($notif));
} catch (Exception $e) {
    error_log("Error processing Midtrans callback: " . $e->getMessage());
}
?>
