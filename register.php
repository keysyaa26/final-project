<?php

session_start();
include 'src/Peserta.php';
// include 'src/Pembayaran.php';
include 'src/qr_code.php';
include 'includes/config.php';

// Midtrans Configuration
require_once 'vendor/midtrans/midtrans-php/Midtrans.php';
\Midtrans\Config::$serverKey = 'SB-Mid-server-LMk3IOcT-CmcBaVt1kVIT93T'; // Ganti dengan server key Midtrans Anda
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

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


    // method pembayaran dan cek harga acara
    $amount = (int)$event['price'];
 
    if($amount > 0) {
        
        // Jika harga event lebih besar dari 0, proses pembayaran dengan Midtrans
        $transactionDetails = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $amount,
        ];

        // Item Details
        $itemDetails = [
            [
                'id' => 'TICKET-' . $event_id,
                'price' => $amount,
                'quantity' => 1,
                'name' => $event['title'],
            ],
        ];

        // Customer Details
        $customerDetails = [
            'first_name' => $name,
            'email' => $email,
            'phone' => $phone,
        ];

        // Transaction Parameters
        $transactionParams = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            // Get Midtrans Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($transactionParams);
            $_SESSION['registration_data'] = [
                'event_id' => $event_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'snap_token' => $snapToken,
            ];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
        }

        // Handle Payment Success
        if (isset($_GET['payment_status']) && $_GET['payment_status'] === 'success') {
            $registrationData = $_SESSION['registration_data'];
            if (!$registrationData) {
                die('Data registrasi tidak ditemukan.');
            }
        }

    // cek data peserta di db attendee
    $stmt = $pdo->prepare("SELECT * FROM attendee WHERE email = ?");
    $stmt->execute([$email]);
    $existing_user = $stmt->fetch();

    
    // masuk ke tb attendee
    if($existing_user['email'] != $email) {
        $peserta = new Peserta($name, $email, $phone);
        $id_attendee = $peserta->Daftar($pdo);
    }

    $id_attendee = $existing_user['attendee_ID'];
    // method kirim email
    $qrcodeMailer = new QRCodeMailer();
    $qrCodeFile = $qrcodeMailer->generateQRCode($id_attendee, $event_id, $email);

    // save data regist event
    $peserta = new Peserta($name, $email, $phone);
    $peserta->saveRegistrationData($pdo, $id_attendee, $event_id, $qrCodeFile, $amount);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi untuk <?= htmlspecialchars($event['title']) ?></title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-oPc2Fv1z8uUBIT4d"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<script>
    <?php if (isset($snapToken)): ?>
    const snapToken = <?= json_encode($snapToken) ?>;
    snap.pay(snapToken, {
        onSuccess: function(result) {
            // Menampilkan popup dengan SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil!',
                text: 'Terima kasih, pembayaran Anda telah berhasil diproses.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Anda bisa melakukan tindakan setelah popup ditutup (misalnya redirect atau lainnya)
                    window.location.href = "?payment_status=success"; // Ini bisa Anda sesuaikan
                }
            });
        },
        onPending: function() {
            alert("Pembayaran tertunda!");
            },
        onError: function() {
            alert("Pembayaran gagal!");
        }
    });
    <?php endif; ?>
</script>

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
        
    }
    
    // menampilkan status pengiriman email
    <?php if (isset($emailStatus) && $emailStatus === 'success') { ?>
        showNotification('success');
    <?php } elseif (isset($emailStatus) && $emailStatus === 'failed') { ?>
        showNotification('failed');
    <?php } ?>

</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function successRegister() {
      Swal.fire({
        position: 'top-center',
        icon: 'success',
        html: document.getElementById("msg").value,
        showConfirmButton: false,
        timer: 1500
      }).then(function() {
        window.location.href = 'index.php';
      })
    }
</script>
</body>
</html>