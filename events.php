<?php
    session_start();
    include 'includes/config-key.php';
    $event_id=2;

    $stmt = $pdo->prepare("SELECT * FROM acara WHERE id_acara = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT); // Bind parameter
    $stmt->execute();
    $event = $stmt->fetch();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Events Page</title>

    <style>
        .custom-btn {
            background-color: #C92127;
            border-color: #C92127;
            color: white;
        }

        .custom-btn:hover {
            background-color: #a51b20;
            border-color: #C92127;
        }

        .custom-img {
            width: 200px;
            /* Anda bisa mengatur ukuran sesuai kebutuhan */
            height: auto;
        }

        /* Container untuk gambar acara */
        .img-container {
            display: flex; /* Menggunakan flexbox untuk tata letak */
            justify-content: center; /* Menyusun gambar di tengah horizontal */
            align-items: center; /* Menyusun gambar di tengah vertikal jika diperlukan */
            height: 400px; /* Menentukan tinggi container, sesuaikan jika diperlukan */
            margin-bottom: 20px; /* Memberikan jarak di bawah gambar */
        }

        /* Gambar acara */
        .event-img {
            max-width: 100%; /* Membuat gambar responsive, mengikuti lebar container */
            height: auto; /* Menjaga rasio gambar agar tetap proporsional */
            border-radius: 8px; /* Opsional, jika ingin memberikan border melengkung */
        }

    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #2C2C7C;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Home</a> <!-- Link untuk kembali ke Home -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="events.html">EVENTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

     <!-- Content of Events Page -->
     <div class="container my-5">
        <h1 class="text-center" style="color: #191970;">Detail Acara</h1>
        <?php if ($event): ?>
        <div class="card mt-4">
            <!-- Menampilkan gambar acara -->
            <div class='img-container'><img src="admin/uploads/<?= htmlspecialchars($event['foto_acara']); ?>" class="card-img-top custom-img" alt='Foto Acara' class='event-img'></div>
            <!-- -->
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($event['nama_acara']); ?></h3>
                <p class="card-text"><strong>Lokasi:</strong> Lokasi Acara</p>
                <p class="card-text"><strong>Tanggal & Waktu:</strong> <?= date('d-m-Y H:i', strtotime($event['tanggal_mulai'])); ?></p>
                <p class="card-text"><?= htmlspecialchars($event['deskripsi_acara']); ?></p>
                <a href="register.php" class="btn custom-btn">Daftar Sekarang!</a>
            </div>
        </div>
        <?php else: ?>
            <p>Acara tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4" style="background-color: #191970; color: white;">
        <p class="mb-0">&copy; 2024 Event Center. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>