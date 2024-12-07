<?php
session_start();
include 'includes/config.php';
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Writer\PngWriter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Konfigurasi Midtrans
require_once 'vendor/midtrans/midtrans-php/Midtrans.php';
\Midtrans\Config::$serverKey = 'SB-Mid-server-LMk3IOcT-CmcBaVt1kVIT93T'; // Ganti dengan server key Midtrans Anda
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Fungsi untuk mengirim email dengan QR Code
function sendEmail($email, $name, $qrPath) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bproticdummy@gmail.com';
        $mail->Password = 'fykj inlz iaiv fnts';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('bproticdummy@gmail.com', 'BPROTIC');
        $mail->addAddress($email, $name);
        $mail->Subject = 'Tiket Event Anda';
        $mail->Body = "Terima kasih sudah mendaftar untuk event kami! Silakan temukan QR code Anda terlampir sebagai tiket masuk.";
        $mail->addAttachment($qrPath);
        $mail->send();
    } catch (Exception $e) {
        die("Error mengirim email: {$mail->ErrorInfo}");
    }
}

// Fungsi untuk membuat QR Code
function createQrCode($registrationId, $eventId, $attendeeId) {
    $qrContent = "$registrationId:$eventId";
    $qrBuilder = new Builder(
        writer: new PngWriter(),
        data: ($qrContent),
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::High,
        labelText: 'Scan QR di Pintu Masuk',
        labelAlignment: LabelAlignment::Center
    );
    $result = $qrBuilder->build();
    $qrDir = 'uploads/qr_code/';
    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }
    // Nama file QR Code berdasarkan event_ID dan attendee_ID
    $qrFilename = "qr_{$eventId}_{$attendeeId}.png";
    $qrPath = $qrDir . $qrFilename;
    $result->saveToFile($qrPath);
    return $qrFilename; // Hanya kembalikan nama file untuk disimpan di database
}

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch();

    // Validasi apakah event ditemukan
    if (!$event) {
        echo "<h2 class='text-center mb-4' style='color: #191970;'>Event Tidak Ditemukan</h2>";
        exit;
    }
} else {
    echo "<h2 class='text-center mb-4' style='color: #191970;'>Event Tidak Ditemukan</h2>";
    exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Pastikan data event digunakan dengan default value jika null
    $eventTitle = htmlspecialchars($event['title'] ?? '');
    $eventPrice = htmlspecialchars($event['price'] ?? 0);

    // Validasi: Periksa apakah email sudah terdaftar untuk event yang sama
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM event_ticket_assignment 
            WHERE event_ID = ? 
            AND attendee_ID IN (SELECT attendee_ID FROM attendee WHERE email = ?)
        ");
        $stmt->execute([$event_id, $email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists) {
            echo '<div class="text-center mt-5"><h3>Email ini sudah terdaftar untuk event ini.</h3><a href="index.php" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a></div>';
            exit;
        }

    // Ambil harga event
    $amount = $event['price'];

    // Masukkan data ke tabel attendee jika pengguna baru
    $stmt = $pdo->prepare("SELECT attendee_ID FROM attendee WHERE email = ?");
    $stmt->execute([$email]);
    $attendee = $stmt->fetch();

    if (!$attendee) {
        $stmt = $pdo->prepare("INSERT INTO attendee (name, email, phone) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $phone]);
        $attendeeId = $pdo->lastInsertId();
    } else {
        $attendeeId = $attendee['attendee_ID'];
    }

    // Proses jika event gratis
    if ($amount == 0) {
        $ticketId = uniqid('TICKET-'); // Generate ticket_ID
        $purchaseDate = date('Y-m-d H:i:s');
        
        // Buat QR Code dengan nama file berdasarkan event_ID dan attendee_ID
        $qrFilename = createQrCode($ticketId, $event_id, $attendeeId);
    
        // Masukkan data ke tabel event_ticket_assignment
        $stmt = $pdo->prepare("
            INSERT INTO event_ticket_assignment (ticket_ID, attendee_ID, event_ID, purchase_date, price, QR_code) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$ticketId, $attendeeId, $event_id, $purchaseDate, $amount, $qrFilename]);
    
        // Kirim email dengan QR code
        sendEmail($email, $name, "uploads/qr_code/{$qrFilename}");
    
        $_SESSION['notification'] = [
            'type' => 'success',
            'title' => 'Registrasi Berhasil!',
            'message' => 'Tiket telah dikirim ke email Anda.'
        ];
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $event_id);
        exit;
    }
    
    // Proses jika event berbayar
    $transactionDetails = ['order_id' => 'ORDER-' . uniqid(), 'gross_amount' => $amount];
    $callbacks = ['finish' => 'http://final-project.test/register.php?id=' . $event_id . '&payment_status=success'];
    $itemDetails = [['id' => 'TICKET-' . $event_id, 'price' => $amount, 'quantity' => 1, 'name' => $event['title']]];
    $customerDetails = ['first_name' => $name, 'email' => $email, 'phone' => $phone];
    $transactionParams = [
        'transaction_details' => $transactionDetails,
        'item_details' => $itemDetails,
        'customer_details' => $customerDetails,
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($transactionParams);
        $_SESSION['registration_data'] = [
            'event_id' => $event_id,
            'attendee_id' => $attendeeId,
            'snap_token' => $snapToken,
        ];
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

// Jika pembayaran sukses
if (isset($_GET['payment_status']) && $_GET['payment_status'] === 'success') {
    $registrationData = $_SESSION['registration_data'];
    if (!$registrationData) die('Data registrasi tidak ditemukan.');

    $transactionStatus = $_GET['transaction_status'];
    if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
        // Pembayaran berhasil
        $ticketId = uniqid('TICKET-'); 
        $purchaseDate = date('Y-m-d H:i:s');

        // Buat QR Code dengan nama file berdasarkan event_ID dan attendee_ID
        $qrFilename = createQrCode($ticketId, $registrationData['event_id'], $registrationData['attendee_id']);

        // Masukkan data ke tabel event_ticket_assignment
        $stmt = $pdo->prepare("
            INSERT INTO event_ticket_assignment (ticket_ID, attendee_ID, event_ID, purchase_date, price, QR_code) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$ticketId, $registrationData['attendee_id'], $registrationData['event_id'], $purchaseDate, $event['price'], $qrFilename]);

        // Kirim email dengan QR code
        sendEmail($registrationData['email'], $name, "uploads/qr_code/{$qrFilename}");

        unset($_SESSION['registration_data']);
        
        // Redirect atau beri informasi bahwa registrasi sukses
        echo "<h2 class='text-center'>Pembayaran Sukses!</h2>";
        exit;
    } else {
        // Status pembayaran tidak berhasil
        echo "<h2 class='text-center'>Pembayaran Gagal!</h2>";
        exit;
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .navbar {
            background-color: #191970 !important;
        }
        .btn-primary {
            background-color: #a51b20;
            border-color: #a51b20;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/images/logo-bprotic.png" alt="Logo" width="40" height="40" class="me-2">
                BPROTIC
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#footer">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Registration Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #191970;">Registrasi untuk <?= htmlspecialchars($event['title']) ?></h2>
            <form method="POST" class="w-50 mx-auto">
                <input type="hidden" name="event_id" value="<?= $event_id ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </section>
    
    <!-- About and Social Media Section -->
    <section>
        <div class="container-fluid py-5" style="background-color: #2C2C7C;">
            <div class="d-flex justify-content-between align-items-center mx-5">
                <!-- About Section -->
                <div class="about-section" style="flex: 1; margin-right: 50px;">
                    <h4 class="mb-3" style="color: #ffffff;">About</h4>
                    <p style="line-height: 1.8; color: #FFFFFF;">
                        Event Center adalah platform penyelenggaraan acara yang menyediakan berbagai informasi terkini
                        mengenai event-event menarik yang dapat diikuti. Kami berdedikasi untuk memberikan pengalaman
                        terbaik dalam menemukan dan mendaftar acara.
                    </p>
                </div>

                <!-- Social Media Section -->
                <div class="social-media-section text-center" style="flex: 1;">
                    <h4 class="mb-3" style="color: #FFFFFF;">Follow Us on Social Media</h4>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.x.com" target="_blank" rel="noopener noreferrer" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset($_SESSION['notification'])): ?>
        <script>
            Swal.fire({
                icon: <?= json_encode($_SESSION['notification']['type']) ?>,
                title: <?= json_encode($_SESSION['notification']['title']) ?>,
                text: <?= json_encode($_SESSION['notification']['message']) ?>,
                confirmButtonText: 'Kembali ke Halaman Utama',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        </script>
        <?php unset($_SESSION['notification']); ?>
    <?php endif; ?>

    <script>
        <?php if (isset($snapToken)): ?>
        const snapToken = <?= json_encode($snapToken) ?>;
        snap.pay(snapToken, {
        onSuccess: function(result) {
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: 'Tiket telah dikirim ke email Anda.',
                confirmButtonText: 'Kembali ke Halaman Utama',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        exit;
        },
        onPending: function(result) {
            console.log("Pembayaran tertunda:", result);
            alert("Pembayaran tertunda!");
        },
        onError: function(result) {
            console.log("Pembayaran gagal:", result);
            alert("Pembayaran gagal!");
        },
        onClose: function() {
            console.log("Pembayaran ditutup oleh pengguna.");
        }
    });
        <?php endif; ?>
    </script>

    <!-- Footer -->
    <footer class="text-center py-4" style="background-color: #191970; color: white;">
        <p class="mb-0">&copy; 2024 Event Center. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>