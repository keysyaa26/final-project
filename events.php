<?php
include 'includes/config.php'; // Sambungkan ke file konfigurasi database
include 'header.php'; // Header

// Query untuk semua events
$stmt = $pdo->prepare("SELECT * FROM events ORDER BY date ASC");
$stmt->execute();
$events = $stmt->fetchAll();
?>

<!-- Daftar Event Section -->
<div class="events-section" style="margin-top:100px; margin-bottom:100px;">
    <div>
        <h1 class="text-center" style="color: #191970;">Daftar Event</h1>
    </div>
</div>

<!-- Daftar Event Cards -->
<div class="row m-3">
    <?php foreach ($events as $event): ?>
        <div class="card col-md-3" style="width: 18rem;">
            <img src="assets/img/poster/<?= htmlspecialchars($event['poster']); ?>" class="custom-card-img card-img-top"
                alt="<?= htmlspecialchars($event['title']) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                <p class="card-text">Tempat: <?= htmlspecialchars($event['location']) ?></p>
                <p class="card-text">Waktu: <?= date('d M Y, H:i', strtotime($event['date'])) ?></p>
                <a href="event_detail.php?id=<?= $event['id'] ?>" class="btn custom-btn">See Details</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'footer.php'; // Footer
?>