<?php
session_start();
include 'includes/config.php';
include 'header.php';

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT); // Bind parameter
    $stmt->execute();
    $event = $stmt->fetch();
} else {
    echo "Event tidak ditemukan.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Detail Event</title>

    <style>
        .custom-img {
            width: 350px;
            /* Anda bisa mengatur ukuran sesuai kebutuhan */
            height: auto;
        }

        /* Container untuk gambar acara */
        .img-container {
            display: flex;
            /* Menggunakan flexbox untuk tata letak */
            justify-content: center;
            /* Menyusun gambar di tengah horizontal */
            align-items: center;
            /* Menyusun gambar di tengah vertikal jika diperlukan */
            height: 400px;
            /* Menentukan tinggi container, sesuaikan jika diperlukan */
            margin-bottom: 20px;
            /* Memberikan jarak di bawah gambar */
        }

        /* Gambar acara */
        .event-img {
            max-width: 100%;
            /* Membuat gambar responsive, mengikuti lebar container */
            height: auto;
            /* Menjaga rasio gambar agar tetap proporsional */
            border-radius: 8px;
            /* Opsional, jika ingin memberikan border melengkung */
        }

        h1,
        h2,
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            /* Untuk heading bisa lebih tebal */
        }
    </style>

</head>

<body>
    <!-- Content of Events Page -->
    <div class="container my-5">
        <h1 class="text-center" style="color: #191970;">Detail Acara</h1>
        <?php if ($event): ?>
            <div class="card mt-4">
                <!-- Menampilkan gambar acara -->
                <div class='img-container'><img src="assets/img/poster/<?= htmlspecialchars($event['poster']); ?>"
                        class="card-img-top custom-img" alt='Foto Acara' class='event-img'></div>
                <!-- -->
                <div class="card-body">
                    <h3 class="card-title"><?= htmlspecialchars($event['title']); ?></h3>
                    <p class="card-text"><strong>Lokasi:</strong> Lokasi Acara</p>
                    <p class="card-text"><strong>Tanggal & Waktu:</strong>
                        <?= date('d-m-Y H:i', strtotime($event['date'])); ?></p>
                    <p class="card-text"><?= htmlspecialchars($event['description']); ?></p>
                    <a href="register.php?id=<?= $event['id'] ?>" class="btn custom-btn">Daftar Sekarang!</a>
                </div>
            </div>
        <?php else: ?>
            <p>Acara tidak ditemukan.</p>
        <?php endif; ?>
    </div>

</body>

</html>

<?php include 'footer.php'; ?> 
