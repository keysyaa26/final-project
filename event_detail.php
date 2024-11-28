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

<!-- Content of Events Page -->
<div class="list-section" style="margin-top:100px; margin-bottom:100px;">
    <div>
        <h1 class="text-center" style="color: #191970;">Detail Event</h1>
    </div>
</div>
<?php if ($event): ?>
    <div class="card mx-auto" style="max-width: 400px; margin-bottom: 50px;">
        <!-- Menampilkan gambar acara -->
        <div class='img-container'><img src="assets/img/poster/<?= htmlspecialchars($event['poster']); ?>"
                class="card-img-top custom-img" alt='Foto Acara' class='event-img'></div>
        <!-- -->
        <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($event['title']); ?></h3>
            <p class="card-text"><strong>Lokasi:</strong> Lokasi Acara</p>
            <p class="card-text"><strong>Tanggal & Waktu:</strong> <?= date('d-m-Y H:i', strtotime($event['date'])); ?></p>
            <p class="card-text"><?= htmlspecialchars($event['description']); ?></p>
            <a href="register.php?id=<?= $event['id'] ?>" class="btn custom-btn">Daftar Sekarang!</a>
        </div>
    </div>
<?php else: ?>
    <p>Acara tidak ditemukan.</p>
<?php endif; ?>
</div>

<?php include 'footer.php'; ?>