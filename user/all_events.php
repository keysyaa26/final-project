<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/index/header-index.php';

// Query untuk semua events
$stmt = $pdo->prepare("SELECT * FROM vw_events_data ORDER BY start_date ASC");
$stmt->execute();
$events = $stmt->fetchAll();
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
    </style>

<body>

    <!-- Daftar Event Section -->
    <div class="events-section" style="margin-top:100px; margin-bottom:100px;">
        <div>
            <h1 class="text-center" style="color: #191970;">Daftar Event</h1>
        </div>
    </div>

    <div class="row m-3">
        <?php foreach ($events as $event): ?>
            <?php if ($event["status_aktif"] == TRUE): ?>
                <div class="card col-md-3" style="width: 18rem;">
                    <img src="../assets/uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>"
                        class="custom-card-img card-img-top" alt="<?= htmlspecialchars($event['title']) ?>">

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

                        <a href="event_detail.php?id=<?= $event['event_ID'] ?>" class="btn custom-btn">See Details</a>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</body>

</html>

<?php require __DIR__ .  '/../includes/index/footer-index.php'; ?>