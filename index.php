<?php
include 'includes/config.php';

//Query untuk upcoming events
$query ="
    SELECT events.*, CONCAT(venue.name, ', ', venue.addres_line) AS venue_name
    FROM events
    JOIN venue ON events.venue_ID = venue.venue_ID
    WHERE events.start_date >= CURDATE()
    ORDER BY events.start_date ASC
    LIMIT 3
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="icon" href="img/logo_bprotic.png">
    <title>Landing Page</title>

    <style>
        .custom-btn {
            background-color: #C92127;
            border-color: #C92127;
            color: white;
        }

        .custom-btn:hover {
            background-color: #a51b20;
            border-color: #a51b20;
        }

        .row {
            justify-content: center;
            /* Agar card tetap rapi di tengah */
            gap: 20px;
            /* Menambahkan jarak antar card */
        }

        .card {
            margin: 15px;
        }

        .custom-card-img {
            width: 100%;
            height: 200px;
            /* Tentukan tinggi gambar agar persegi */
            object-fit: cover;
            /* Gambar akan tetap terpotong untuk mengisi area */
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Font Poppins */
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            /* Bisa diubah sesuai kebutuhan */
        }

        h1,
        h2,
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            /* Untuk heading bisa lebih tebal */
        }

        html {
            scroll-behavior: smooth; /* Efek scroll halus */
        }

    </style>
</head>

<body>
    <!-- Navbar Section -->
    <div>
        <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #2C2C7C;">
            <div class="container-fluid">
                <!-- Brand -->
                <img src="assets/img/logo-bprotic.png" alt="" style="height: 40px; width: auto; margin-right: 10px;">
                <a class="navbar-brand" href="#" style="font-weight: bold;">BPROTIC</a>
                <!-- Toggler Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapsible Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="all_events.php">EVENTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#social-media">CONTACT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-section" style="margin-top:100px; margin-bottom:100px;">
        <div>
            <h1 class="text-center" style="color: #191970;">Welcome to Event Center</h1>
        </div>
    </div>

    <!-- Card Events upcoming -->
    <div class="row m-3">
        <?php foreach ($events as $event): ?>
        <div class="card col-md-3" style="width: 18rem;">
            <!-- Cek apakah poster ada, jika tidak, tampilkan gambar default -->
            <img src="assets/img/poster/<?= htmlspecialchars($event['poster']); ?>" class="custom-card-img card-img-top"
                alt="<?= htmlspecialchars($event['title']) ?>">
            <div class="card-body">
                <h5 class="card-title">
                    <?= htmlspecialchars($event['title']) ?>
                </h5>
                <p class="card-text">Tempat:
                    <?= htmlspecialchars($event['venue_name']) ?>
                </p>
                <p class="card-text">Waktu: 
                    <?= date('l, jS F Y H:i', strtotime($event['start_date'])) ?> 
                    <?php if (!empty($event['end_date'])): ?>
                        - <?= date('l, jS F Y H:i', strtotime($event['end_date'])) ?>
                    <?php endif; ?>
                </p>
                <a href="event_detail.php?id=<?= $event['event_ID'] ?>" class="btn custom-btn">See Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- About and Social Media Section -->
    <div class="container-fluid py-5" style="background-color: #2C2C7C;">
        <div class="d-flex justify-content-between align-items-center mx-5">
            <!-- About Section -->
            <div class="about-section" style="flex: 1; margin-right: 50px;">
                <h4 class="mb-3" style="color: #ffffff;">About</h4>
                <p style="line-height: 1.8; color: #FFFFFF;">
                    Event Center adalah platform penyelenggaraan acara yang menyediakan berbagai informasi terkini
                    mengenai event-event menarik yang dapat diikuti. Kami berdedikasi untuk memberikan pengalaman
                    terbaik
                    dalam menemukan dan mendaftar acara.
                </p>
            </div>

            <!-- Social Media Section -->
            <div class="social-media-section text-center" id="social-media" style="flex: 1;">
                <h4 class="mb-3" style="color: #FFFFFF;">Follow Us on Social Media</h4>
                <div class="d-flex justify-content-center mt-3">
                    <a href="#" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="text-decoration-none mx-3" style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>

        </div>
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