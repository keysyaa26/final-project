<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Mpdf\Mpdf;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Fungsi untuk menghasilkan PDF dan mengirimkan email
function generate_and_send_invoice($order_id, $toEmail, $invoiceData, $isPending = false) {
    try {
        // Extract invoice data
        $order_id = $invoiceData['order_id'];
        $purchase_date = $invoiceData['transaction_date'];
        $name = $invoiceData['name'];
        $email = $invoiceData['email'];
        $phone = $invoiceData['phone'];
        $title = $invoiceData['title'];
        $subtotal = $invoiceData['subtotal'];
        $payment_url = $isPending ? $invoiceData['payment_url'] : null;

        // Membuat PDF dengan mPDF
        $mpdf = new Mpdf();

        // Konten HTML untuk invoice
        $html = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .invoice-container { width: 100%; max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h1 { margin: 0; font-size: 24px; }
                .header p { margin: 0; font-size: 14px; color: #555; }
                .section { margin-bottom: 20px; }
                .section h3 { margin: 0; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px; }
                .details-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                .details-table th, .details-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                .details-table th { background-color: #f9f9f9; }
                .total { text-align: right; font-weight: bold; margin-top: 20px; }
                .payment-button { margin-top: 20px; text-align: center; }
                .payment-button a { display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 4px; font-size: 14px; }
            </style>
        </head>
        <body>
            <div class='invoice-container'>
                <div class='header'>
                    <h1>Invoice</h1>
                    <p>BPROTIC Event Management</p>
                </div>
                <div class='section'>
                    <h3>Invoice Details</h3>
                    <table class='details-table'>
                        <tr>
                            <th>Order ID</th>
                            <td>{$order_id}</td>
                        </tr>
                        <tr>
                            <th>Transaction Date</th>
                            <td>{$purchase_date}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{$name}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{$email}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{$phone}</td>
                        </tr>
                        <tr>
                            <th>Event Name</th>
                            <td>{$title}</td>
                        </tr>
                    </table>
                </div>
                <div class='section'>
                    <h3>Payment Summary</h3>
                    <table class='details-table'>
                        <tr>
                            <th>Subtotal</th>
                            <td>Rp " . number_format($subtotal, 2, ',', '.') . "</td>
                        </tr>
                    </table>
                    <p class='total'>Total: Rp " . number_format($subtotal, 2, ',', '.') . "</p>
                </div>";

        // Menambahkan tombol pembayaran untuk status pending
        if ($isPending && $payment_url) {
            $html .= "
                <div class='payment-button'>
                    <a href='{$payment_url}' target='_blank'>Bayar Sekarang</a>
                </div>";
        }

        $html .= "
            </div>
        </body>
        </html>";

        // Menulis konten HTML ke PDF
        $mpdf->WriteHTML($html);
        $filePath = __DIR__ . "/../assets/uploads/invoices/invoice_{$order_id}.pdf";
        $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

        // Mengirimkan email dengan PHPMailer
        $mail = new PHPMailer(true);

        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Pengirim dan Penerima
        $mail->setFrom($_ENV['SMTP_USER'], 'BPROTIC');
        $mail->addAddress($toEmail);

        // Konten Email
        $mail->isHTML(true);
        $mail->Subject = "Invoice for Order #{$order_id}";
        $mail->Body = "
            <h2>Invoice for Your Order</h2>
            <p>Dear {$invoiceData['name']},</p>
            <p>Thank you for your order. Please find your invoice attached.</p>";

        if ($isPending) {
            $mail->Body .= "
                <p>Your order is currently <strong>Pending</strong>. Please click the link below to complete your payment:</p>
                <p><a href='{$invoiceData['payment_url']}' style='padding: 10px 15px; background: #007bff; color: white; text-decoration: none;'>Bayar Sekarang</a></p>";
        } else {
            $mail->Body .= "<p>Your payment has been successfully processed. Thank you!</p>";
        }

        // Menambahkan lampiran PDF ke email
        $mail->addAttachment($filePath, "Invoice_{$order_id}.pdf");

        // Mengirim email
        $mail->send();
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Invoice sent successfully to {$toEmail}\n", FILE_APPEND);

    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/../midtrans/debug_sql.log', date('Y-m-d H:i:s') . " Error generating and sending invoice: " . $e->getMessage() . "\n", FILE_APPEND);
        error_log("Error generating and sending invoice: " . $e->getMessage());
    }
}
?>
