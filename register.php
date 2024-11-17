<?php
session_start();
include 'includes/config-key.php';
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// set id acara, ini bisa diubah
$event_id=1;
$stmt = $pdo->prepare("SELECT * FROM acara WHERE id_acara = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();
if (!$event) {
    echo "Event tidak ditemukan!";
    exit;}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $prodi = $_POST['prodi'];

    $stmt = $pdo->prepare("INSERT INTO peserta (nama_peserta, email_peserta, no_telepon, prodi_peserta) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $prodi]);
    $id_peserta = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO acara_has_peserta (acara_id, peserta_id) VALUES (?, ?)");
    $stmt->execute([$event_id, $id_peserta]);

    // membuat qr code
    $qrContent = "$id_peserta:$event_id";

    $builder = new Builder(
        writer: new PngWriter(),
        data: ($qrContent),
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::High,
        labelText: 'Scan QR di Pintu Masuk',
        labelAlignment: LabelAlignment::Center
    );

    $result = $builder->build();

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $qrPath = "uploads/qr_$id_peserta.png";
    $result->saveToFile($qrPath);


    // mengirim email
    $to_email = $email; 
    $subject = 'QR code Presensi' . htmlspecialchars($event['nama_acara']);
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
        $mail->addAddress($email, $name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->addAttachment($qrPath);

        $mail->send();
        $emailStatus = 'success';
    } catch (Exception $e) {
        $emailStatus = 'failed';
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi untuk <?= htmlspecialchars($event['nama_acara']) ?></title>

    <style>
        /* Reset default styles */
        body, h2, form {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }


        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="hidden"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        button:focus {
            border-color: #0077B6;
            outline: none;
        }

        button {
            background-color: #0077B6;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 480px) {
            .form-container {
                padding: 20px;
                margin: 10px;
                max-width: 100%;
            }
        }

        /* Notifikasi Melayang */
        .notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            display: none;
            z-index: 1000;
        }

        .notification.show {
            display: block;
            animation: fadeIn 2s, fadeOut 2s 3s forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrasi untuk <?= htmlspecialchars($event['nama_acara']) ?></h2>
        
        <!-- Formulir Pendaftaran -->
        <form method="POST">
            <input type="hidden" name="event_id" value="<?= $event_id ?>">
            <label>Nama: <input type="text" name="name" required></label>
            <label>Email: <input type="email" name="email" required></label>
            <label>Telepon: <input type="text" name="phone"></label>
            <label>Prodi: <input type="text" name="prodi"></label>
            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- Notifikasi -->
    <div id="notification" class="notification">QR Code berhasil dikirim melalui email!</div>
    <script>
        function showNotification(status) {
            var notification = document.getElementById('notification');
            if (status === 'success') {
                notification.textContent = 'QR Code berhasil dikirim melalui email!';
                notification.classList.remove('error');
            } else {
                notification.textContent = 'Pesan gagal dikirim. Coba lagi.';
                notification.classList.add('error');
            }
            notification.classList.add('show');
            
            setTimeout(function() {
                notification.classList.remove('show');
            }, 5000); // 5 deitk
        }

        <?php if ($emailStatus === 'success') { ?>
            showNotification('success');
        <?php } elseif ($emailStatus === 'failed') { ?>
            showNotification('failed');
        <?php } ?>
    </script>
</body>
</html>