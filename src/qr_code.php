<?php
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../vendor/autoload.php';

class QRCodeMailer {
    private $mail;

    public function __construct() {
        // inisialisaasi
        $this->mail = new PHPMailer(true);

        // Set up email server
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'bproticdummy@gmail.com';
        $this->mail->Password ='hefk xvuq srzg tqsg';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;

        $this->mail->setFrom('bproticdummy@gmail.com', 'BPROTIC EVENTS');
    }

    public function generateQRCode($event_id, $id_peserta, $email) {
        $qrContent = "{$id_peserta}:{$event_id}";

        $builder = new Builder(
            writer: new PNGWriter(),
            data: $qrContent,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            labelText: 'Scan QR di Pintu Masuk',
            labelAlignment: LabelAlignment::Center
        );
        
        $result = $builder->build();

        // Pastikan folder uploads ada
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Tentukan path QR code
        $qrPath = "uploads/qr_{$id_peserta}.png";
        $result->saveToFile($qrPath);

        // Kirim email dengan QR code
        $this->sendQRCodeEmail($email, $qrPath);
    }

    public function sendQRCodeEmail($recipientEmail, $qrCodeFile) {
        try {
            // Penerima email
            $this->mail->addAddress($recipientEmail);

            $this->mail->Subject = "QR code Presensi: Event Anda";
            $this->mail->Body    = 'Terima kasih sudah mendaftar untuk event kami! Silakan temukan QR code Anda terlampir sebagai tiket masuk.';
            $this->mail->addAttachment($qrCodeFile); // QR code sebagai lampiran

            // Kirim email
            $this->mail->send();
            $message = '<p><b>Email dengan QR Code telah dikirim!</b></p>';
                echo "<body onload='successRegister()'><input type='hidden' id='msg' value='" . $message . "''></input></body>";
                return false;
            echo 'Email dengan QR Code telah dikirim!';
        } catch (Exception $e) {
            echo "Pesan tidak dapat dikirim. Kesalahan: {$this->mail->ErrorInfo}";
        }
    }

    // fungsi untuk simpan qr code ke event_ticket_assignment
}


?>