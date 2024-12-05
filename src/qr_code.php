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
        $this->mail->Password ='fykj inlz iaiv fnts';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;

        $this->mail->setFrom('bproticdummy@gmail.com', 'BPROTIC EVENTS');
    }

    public function generateQRCode($event_id, $registration_id, $email) {
        $qrContent = "{$registration_id}:{$event_id}";

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
        if (!is_dir('../uploads/qr_code')) {
            mkdir('../uploads/qr_code', 0777, true);
        }        

        // Tentukan path QR code
        $qrPath =__DIR__ . "/../uploads/qr_code/qr_{$registration_id}.png";
        $result->saveToFile($qrPath);

        $qrFileName = "qr_{$registration_id}.png";

        // kirim email + qrcode
        $this->sendQRCodeEmail($email, $qrPath);

        return $qrFileName;
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

}


?>