<?php
include 'includes/config.php';
include 'header-index.php';

// Query untuk upcoming events
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
    <link rel="stylesheet" href="assets/css/styles.css">
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
                <img src="uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>" 
                     class="custom-card-img card-img-top" 
                     alt="<?= htmlspecialchars($event['title']) ?>">

                <div class="card-body">
                    <h5 class="card-title">
                        <strong><?= htmlspecialchars($event['title']) ?></strong>
                    </h5>
                    <p class="card-text">Tempat: <?= htmlspecialchars($event['venue_name']) ?></p>
                    <p class="card-text">Waktu: 
                        <?= date('l, jS F Y H:i', strtotime($event['start_date'])) ?> 
                        <?php if (!empty($event['end_date'])): ?>
                            - <?= date('l, jS F Y H:i', strtotime($event['end_date'])) ?>
                        <?php endif; ?>
                    </p>

                    <!-- HTM -->
                    <?php if ($event['price'] > 0): ?>
                        <p class="card-text">HTM: <?= htmlspecialchars($event['price']) ?></p>
                    <?php endif; ?>
                    
                    <a href="event_detail.php?id=<?= $event['event_ID'] ?>" class="btn custom-btn">See Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>

<?php include 'footer-index.php'; ?>