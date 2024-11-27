<?php

session_start();
include 'src/Peserta.php';
include 'src/qr_code.php';
include 'includes/config.php';

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch();
} else {
    echo "Event tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    $peserta = new Peserta($name, $email, $phone);
    $id_attendee = $peserta->Daftar($pdo);
    // method pembayaran

    // method kirim email
    $qrcodeMailer = new QRCodeMailer();
    $qrCodeFile = $qrcodeMailer->generateQRCode($id_attendee, $event_id, $email);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi untuk <?= htmlspecialchars($event['title']) ?></title>

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
        <h2>Registrasi untuk <?= htmlspecialchars($event['title']) ?></h2>
        
        <!-- Formulir Pendaftaran -->
        <form method="POST">
            <input type="hidden" name="event_id" value="<?= $event_id ?>">
            <label>Nama: <input type="text" name="name" required></label>
            <label>Email: <input type="email" name="email" required></label>
            <label>Telepon: <input tyipe="text" name="phone"></label>
            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- Notifikasi -->
<div id="notification" class="notification">QR Code berhasil dikirim melalui email!</div>

<script>
    function showNotification(status) {
        console.log(status); // Debug log
        var notification = document.getElementById('notification');
        
        if (status === 'success') {
            notification.textContent = 'QR Code berhasil dikirim melalui email!';
            notification.classList.remove('error');
        } else {
            notification.textContent = 'Pesan gagal dikirim. Coba lagi.';
            notification.classList.add('error');
        }
        
        notification.classList.add('show');
        
        // Setelah 5 detik, sembunyikan notifikasi
        setTimeout(function() {
            notification.classList.remove('show');
        }, 5000); // 5 detik
    }

    // PHP untuk menampilkan status pengiriman email
    <?php if (isset($emailStatus) && $emailStatus === 'success') { ?>
        showNotification('success');
    <?php } elseif (isset($emailStatus) && $emailStatus === 'failed') { ?>
        showNotification('failed');
    <?php } ?>
</script>

</body>
</html>