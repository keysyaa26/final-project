<?php
include 'includes/config.php';
include 'header.php';


//Query untuk upcoming events
$stmt = $pdo->prepare("SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 3");
$stmt->execute();
$events = $stmt->fetchAll();

?>
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
                        <?= htmlspecialchars($event['location']) ?>
                    </p>
                    <p class="card-text">Waktu:
                        <?= date('d M Y, H:i', strtotime($event['date'])) ?>
                    </p>
                    <a href="event_detail.php?id=<?= $event['id'] ?>" class="btn custom-btn">See Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

<?php
include 'footer.php';
?>