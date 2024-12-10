<?php
require 'vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Fungsi untuk membuat QR Code
function generateQRCode($content, $filepath) {
    $qrCode = new QrCode($content);
    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    $result->saveToFile($filepath);
}

// Fungsi untuk mengirim email
function sendEmail($toEmail, $qrCodePath, $eventTitle) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $mail = new PHPMailer(true);
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Detail pengirim dan penerima
        $mail->setFrom($_ENV['SMTP_USER'], 'BPROTIC');
        $mail->addAddress($toEmail);

        // Lampiran
        $mail->addAttachment($qrCodePath, 'QR_Code.png');

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Tiket untuk Acara: $eventTitle";
        $mail->Body = "Terima kasih telah mendaftar untuk acara <b>$eventTitle</b>. Silakan temukan QR Code Anda di lampiran.";

        $mail->send();
    } catch (Exception $e) {
        error_log("Email gagal dikirim: {$mail->ErrorInfo}");
    }
}
?>
