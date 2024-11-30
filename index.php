<?php
include 'includes/config.php';
include 'header-index.php';

//Query untuk upcoming events
$query ="
    SELECT * FROM vw_events_data
    WHERE vw_events_data.start_date >= CURDATE()
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

</head>

<body>

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
            <img src="uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>" class="custom-card-img card-img-top" alt="<?= htmlspecialchars($event['title']) ?>">

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
                <?php if($event['price'] > 0):?>
                    <p class="card-text">HTM:
                        <?= htmlspecialchars($event['price']) ?>
                    </p>
                <?php endif; ?>
                
                <a href="event_detail.php?id=<?= $event['event_ID'] ?>" class="btn custom-btn">See Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- About and Social Media Section -->
    <div class="container-fluid py-5" style="background-color: #2C2C7C;">
        <div class="d-flex justify-content-between align-items-center mx-5 footer-container">
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