<?php
require_once '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Peserta{
    private $id_peserta;
    private $nama;
    private $email;
    private $no_tlp;
    private $emailStatus;

    public function __construct( $nama, $email, $no_tlp) {
        // $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->no_tlp = $no_tlp;
    }

    // setter dan getter
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getNama() {
        return $this->nama;
    }
    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNoHP() {
        return $this->no_tlp;
    }
    public function setNoHP($no_tlp) {
        $this->no_tlp = $no_tlp;
    }

    public function getEmailStatus() {
        return $this->emailStatus;
    }

    // method
    public function Daftar($pdo) {
        $query = "INSERT INTO peserta (nama_peserta, email_peserta, no_tlp) VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $this->nama,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->email,PDO::PARAM_STR); 
        $stmt->bindParam(3, $this->no_tlp,PDO::PARAM_STR);
        $stmt->execute();
        $this->id_peserta = $pdo->lastInsertId();
    }

    public function buatDanKirimQrCode() {
        // Membuat QR Code
        $event_id = 1;
        $qrContent = "{$this->id_peserta}:{event_id}";

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
        $qrPath = "uploads/qr_{$this->id_peserta}.png";
        $result->saveToFile($qrPath);

        // Kirim email dengan QR code
        $this->kirimEmailQrCode($qrPath);
    }

    
    private function kirimEmailQrCode($qrPath) {
        $to_email = $this->email;
        $subject = 'QR code Presensi: Event Anda';
        $body = 'Terima kasih sudah mendaftar untuk event kami! Silakan temukan QR code Anda terlampir sebagai tiket masuk.';

        $mail = new PHPMailer(true);

        try {
            // Konfigurasi server email
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bproticdummy@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'hefk xvuq srzg tqsg'; // Ganti dengan password email Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('bproticdummy@gmail.com', 'Event Organizer');
            $mail->addAddress($to_email, $this->nama);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->addAttachment($qrPath);

            $mail->send();
            $emailStatus = 'success';
            } catch (Exception $e) {
                $emailStatus = 'failed';
            }
    }
}

?>