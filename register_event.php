<?php

require 'includes/config.php';
require 'vendor/autoload.php';
require 'src/qr_code.php';
require 'midtrans/midtrans_config.php';
require __DIR__ . '/includes/index/header-index.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Mengambil event_id dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];
} else {
    die("Event ID tidak ditemukan.");
}

// Ambil data event berdasarkan event_id
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
$stmt->execute(['event_id' => $event_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika event tidak ditemukan
if (!$event) {
    die("Event tidak ditemukan.");
}

// Validasi email dengan AJAX
if (isset($_GET['validate_email']) && !empty($_GET['email'])) {
    $email = trim($_GET['email']);
    $check_email_stmt = $pdo->prepare("SELECT * FROM attendee a 
                                       JOIN event_ticket_assignment e ON a.attendee_ID = e.attendee_ID 
                                       WHERE a.email = :email AND e.event_ID = :event_id");
    $check_email_stmt->execute(['email' => $email, 'event_id' => $event_id]);

    echo json_encode(['exists' => $check_email_stmt->rowCount() > 0]);
    exit;
}

// Validasi input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $price = $event['price'];
    $title = $event['title'];
    $ticket_id = uniqid('ticket_', true);
    $order_id = uniqid('order_', true);
    $purchase_date = date('Y-m-d H:i:s');

    // Validasi nama dan email untuk attendee yang sama
    $check_attendee_stmt = $pdo->prepare("SELECT * FROM attendee WHERE name = :name AND email = :email");
    $check_attendee_stmt->execute(['name' => $name, 'email' => $email]);
    $attendee = $check_attendee_stmt->fetch(PDO::FETCH_ASSOC);

    if ($price <= 0) {
        // Proses untuk event gratis 
        if ($attendee) {
            $attendee_id = $attendee['attendee_ID'];
        } else {
            // Tambahkan peserta baru ke tabel attendee
            $insert_attendee_stmt = $pdo->prepare("INSERT INTO attendee (name, email, phone) VALUES (:name, :email, :phone)");
            $insert_attendee_stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);
            $attendee_id = $pdo->lastInsertId(); // Ambil ID peserta yang baru ditambahkan
        }

        // Ambil informasi acara
        $event_stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
        $event_stmt->execute(['event_id' => $event_id]);
        $event = $event_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            echo '<script>alert("Event tidak ditemukan.");</script>';
            exit;
        }      
        // Buat tiket dan QR Code
        $qr_code_filename = "qr_{$event_id}_{$attendee_id}.png";
        $qr_code_path = "assets/uploads/qr_code/$qr_code_filename";
        generateQRCode($event_id, $attendee_id, $qr_code_path);

        // Simpan ke tabel event_ticket_assignment
        $insert_ticket_stmt = $pdo->prepare("INSERT INTO event_ticket_assignment (ticket_ID, order_id, attendee_ID, event_ID, price, purchase_date, transaction_status, QR_Code, attendance_status) 
                                            VALUES (:ticket_id, :order_id, :attendee_id, :event_id, :price, :purchase_date, :transaction_status, :qr_code, :attendance_status)");
        $insert_ticket_stmt->execute([
            'ticket_id' => $ticket_id,
            'order_id' => $order_id,
            'attendee_id' => $attendee_id,
            'event_id' => $event_id,
            'price' => $price,
            'purchase_date' => $purchase_date,
            'transaction_status' => 'Success',
            'qr_code' => $qr_code_filename,
            'attendance_status' => 'Absen'
        ]);

        // Kirim email tiket
        sendQRCode($email, $qr_code_path, $title);

        header("Location: viewinvoice.php?order_id=$order_id");
        exit;
    } else {
        // Proses pembayaran dengan Midtrans jika harga > 0
        $payload = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $price,
                'payment_link_id' => "paylink-" . $order_id
            ],
            'customer_details' => [
                'first_name' => $name,
                'email' => $email,
                'phone' => $phone
            ],
            'item_details' => [
                [
                    'id' => $event_id,
                    'price' => $price,
                    'quantity' => 1,
                    'name' => $event['title']
                ]
            ],

            'custom_field1' => json_encode([
                'extra_field1' => $name,
                'extra_field2' => $email,
                'extra_field3' => $phone
            ]),
            'custom_field2' => json_encode([
                'extra_field4' => $ticket_id,
                'extra_field5' => $event_id,
                'extra_field6' => $event['title']
            ]),
        ];
        
        
        try {
            $snap_token = \Midtrans\Snap::getSnapToken($payload);

            // Create transaction to get the payment URL
            $response = \Midtrans\Snap::createTransaction($payload);
            $payment_url = $response->redirect_url;

            // Now, include the payment URL into the payload
            $payload['custom_field3'] = $payment_url;
            file_put_contents(__DIR__ . '/midtrans/debug_sql.log', "Payload with custom_field3: " . json_encode($payload) . "\n", FILE_APPEND);
            file_put_contents(__DIR__ . '/midtrans/debug_sql.log', "Payment iafbaibiURL: " . $payment_url . "\n", FILE_APPEND);

        } catch (Exception $e) {
            error_log("Error registering event: " . $e->getMessage());
            $error_message = $e->getMessage();
            file_put_contents(__DIR__ . '/midtrans/debug_sql.log', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
            header('Location: register_event.php?id=' . $event_id . '&notification=error');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script type="text/javascript" 
            src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="<?= htmlspecialchars($_ENV['MIDTRANS_CLIENT_KEY']) ?>">
    </script>
        <script>
        async function validateEmail(input) {
            const email = input.value;
            const response = await fetch(`register_event.php?id=<?= $event_id ?>&validate_email=true&email=${email}`);
            const result = await response.json();

            const notification = document.getElementById('email-notification');
            if (result.exists) {
                notification.textContent = "Email ini sudah terdaftar untuk event ini.";
                input.setCustomValidity("Email sudah digunakan.");
            } else {
                notification.textContent = "";
                input.setCustomValidity("");
            }
        }
    </script>
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

    <!-- Registration Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #191970;">Registrasi untuk Event <?php echo $event['title']; ?></h2>
            <form method="POST" class="w-50 mx-auto">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required oninput="validateEmail(this)">
                    <span id="email-notification" style="color: red;"></span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--- Alerts -->  
    <?php if (isset($_GET['notification'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const allowedNotifications = ['success', 'pending', 'error']; // Nilai yang diperbolehkan
                const urlParams = new URLSearchParams(window.location.search);
                const notification = urlParams.get('notification');

                if (allowedNotifications.includes(notification)) {
                    if (notification === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil!',
                            text: 'Tiket telah dikirim ke email Anda.',
                            confirmButtonText: 'Kembali ke Halaman Utama',
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    } else if (notification === 'error') {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                        });
                    }
                }
            });
        </script>
    <?php endif; ?>


    <?php if (isset($snap_token)): ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const order_id = '<?= $order_id ?>';

                snap.pay('<?= $snap_token ?>', {
                    onSuccess: function(result) {
                        fetch('register_event.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                order_id: order_id,
                                status: 'success'
                            })
                        });

                        // Redirect ke halaman invoice
                        window.location.href = 'viewinvoice.php?order_id=' + order_id;
                    },
                    onPending: function(result) {
                        fetch('register_event.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                order_id: order_id,
                                status: 'pending'
                            })
                        });

                        Swal.fire({
                            icon: 'info',
                            title: 'Transaksi Menunggu Pembayaran',
                            text: 'Invoice telah dikirim ke email Anda. Anda dapat membayar sekarang atau klik lewat tautan di email.',
                            showCancelButton: true,
                            confirmButtonText: 'Bayar Sekarang',
                            cancelButtonText: 'Tutup',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                snap.pay('<?= $snap_token ?>');
                            }
                        });
                    },
                    onError: function(result) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal memproses transaksi Anda. Silakan coba lagi atau hubungi dukungan.',
                            confirmButtonText: 'Kembali ke Halaman Utama',
                            confirmButtonColor: '#3085d6',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    },
                    onClose: function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Transaksi Belum Selesai',
                            text: 'Anda menutup pembayaran. Ingin mencoba lagi?',
                            showCancelButton: true,
                            confirmButtonText: 'Coba Lagi',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                snap.pay('<?= $snap_token ?>');
                            }
                        });
                    }
                });
            });
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require __DIR__ .  '/includes/index/footer-index.php'; ?>
