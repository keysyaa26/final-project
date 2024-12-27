<?php
require 'includes/config.php';
require 'includes/index/header-index.php';

//Query untuk upcoming events
$query = "
    SELECT * FROM vw_events_data
    WHERE vw_events_data.start_date >= CURDATE() AND status_aktif = 1
    ORDER BY vw_events_data.start_date ASC
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

    <link rel="stylesheet" href="assets\css\styles.css">
    <title>Landing Page</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .hero-section {
            background: #191970;
            color: white;
            padding: 150px 0 100px 0;
            text-align: center;
            position: relative;
        }

        .hero-section h1 {
            font-weight: 700;
            font-size: 3rem;
        }

        .hero-section p {
            font-weight: 500;
            font-size: 1.2rem;
        }

        .hero-section img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .carousel {
            margin: 0 auto;
            /* Untuk memastikan carousel berada di tengah */
            border-radius: 10px;
            /* Tambahkan rounded pada ujung carousel jika diinginkan */
            overflow: hidden;
            /* Hindari gambar keluar dari batas carousel */
        }

        .carousel img {
            height: 450px;
            /* Batasi tinggi gambar */
            object-fit: cover;
            /* Pastikan gambar tetap proporsional */
        }

        .activity-icon {
            width: 50px;
            /* Menyesuaikan lebar ikon */
            height: 50px;
            /* Menyesuaikan tinggi ikon */
            margin: 10px;
            object-fit: contain;
            transition: transform 0.3s ease, color 0.3s ease;
            /* Animasi perubahan ukuran dan warna */
        }

        .activity-icon:hover {
            transform: scale(1.2);
            /* Memperbesar ikon saat hover */
            color: #FF5733;
            /* Mengubah warna ikon saat hover */
        }


        /* Perkecil ukuran gambar di event card */
        .event-card img {
            height: 200px;
            /* Atur tinggi maksimal gambar */
            object-fit: cover;
            /* Pastikan gambar tetap proporsional */
            border-radius: 5px;
            /* Tambahkan sedikit rounded agar lebih menarik */
        }

        .event-card {
            transition: transform 0.2s;
        }

        .event-card:hover {
            transform: scale(1.05);
        }

        .event-card .card-title {
            font-weight: 700;
        }
    </style>

</head>

<body>
    
    <!-- Tautan tersembunyi -->
    <a href="https://1378-182-253-128-32.ngrok-free.app/final-project/admin/dashboard.php" style="position: absolute; top: -9999px; left: -9999px;">Admin</a>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to Event Center BPROTIC</h1>
            <p>Empowering ideas, creativity, and collaboration through our events.</p>
            <a href="#events" class="btn btn-light btn-lg mt-4">Explore Events</a>
        </div>
    </section>
    <!-- Carousel Section -->
    <div class="container py-4"> <!-- Tambahkan container di sini -->
        <div id="carouselExampleCaptions" class="carousel slide mx-auto" style="max-width: 80%;" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Atur lebar maksimal -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/foto1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Kunjungan Club Robotic</h5>
                        <p>Universitas Buana Perjuangan Karawang(BPROTIC) ke IBC/Robot Edukasi Universitas Gunadarma</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/foto2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Kunjungan Club Robotic</h5>
                        <p>Universitas Buana Perjuangan Karawang(BPROTIC) ke IBC/Robot Edukasi Universitas Gunadarma</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/foto3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Kunjungan Club Robotic</h5>
                        <p>Universitas Buana Perjuangan Karawang(BPROTIC) ke IBC/Robot Edukasi Universitas Gunadarma</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/foto4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Kunjungan Club Robotic</h5>
                        <p>Universitas Buana Perjuangan Karawang(BPROTIC) ke IBC/Robot Edukasi Universitas Gunadarma</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <hr>
    <!-- Our Activities Section -->
    <section id="activity" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Our Activities</h2>
            <p class="mb-5">We thank you for the support of our activities that make our event possible.</p>
            <div class="d-flex justify-content-center align-items-center flex-wrap mt-4">
                <!-- Activity 1 -->
                <div class="col-md-3 col-sm-6">
                    <img src="assets/img/seminar.png" alt="activity 1" class="img-fluid rounded activity-icon">
                    <p class="mt-2">Seminar Planning</p>
                </div>
                <!-- Activity 2 -->
                <div class="col-md-3 col-sm-6">
                    <img src="assets/img/collab.png" alt="activity 2" class="img-fluid rounded activity-icon">
                    <p class="mt-2">Club Collaboration</p>
                </div>
                <!-- Activity 3 -->
                <div class="col-md-3 col-sm-6">
                    <img src="assets/img/education.png" alt="activity 3" class="img-fluid rounded activity-icon">
                    <p class="mt-2">Robotic Education</p>
                </div>
                <!-- Activity 4 -->
                <div class="col-md-3 col-sm-6">
                    <img src="assets/img/knowledge.png" alt="activity 3" class="img-fluid rounded activity-icon">
                    <p class="mt-2">Sharing Knowledge</p>
                </div>
            </div>
        </div>
    </section>

    <hr>
    <!-- Card Events upcoming -->
    <section id="events" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Upcoming Events</h2>
            <div class="row g-4">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-4">
                        <div class="card event-card">
                            <img src="assets/uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>"
                                class="card-img-top" alt="<?= htmlspecialchars($event['title']) ?>">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong><?= htmlspecialchars($event['title']) ?></strong>
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

                                <!-- HTM -->
                                <?php if ($event['price'] > 0): ?>
                                    <p class="card-text">HTM:
                                        <?= htmlspecialchars($event['price']) ?>
                                    </p>
                                <?php endif; ?>

                                <a href="user/event_detail.php?id=<?= $event['event_ID'] ?>" class="btn btn-primary">See
                                    Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Hotkey Script -->
    <script>
        document.addEventListener('keydown', function (event) {
            if (event.ctrlKey && event.altKey && event.key === 'a') {
                const adminLink = document.createElement('a');
                adminLink.href = 'https://1378-182-253-128-32.ngrok-free.app/final-project/admin/dashboard.php';
                adminLink.textContent = 'Admin Dashboard';
                adminLink.style.position = 'fixed';
                adminLink.style.bottom = '10px';
                adminLink.style.right = '10px';
                adminLink.style.backgroundColor = '#000';
                adminLink.style.color = '#fff';
                adminLink.style.padding = '10px';
                adminLink.style.borderRadius = '5px';
                adminLink.style.zIndex = '9999';

                document.body.appendChild(adminLink);

                setTimeout(() => adminLink.remove(), 5000);
            }
        });
    </script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<?php require 'includes/index/footer-index.php'; ?>