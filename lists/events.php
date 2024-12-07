<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../src/Acara.php';
include '../includes/header.php';
include '../includes/config.php';

// Tambah atau Edit Event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $event_type_id = intval($_POST['event_type_id']);
    $venue_id = intval($_POST['venue_id']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = trim($_POST['description']);
    $status = trim($_POST['status']);
    $price = trim($_POST['price']);
    $event_id = $_POST['event_id'] ?? null;
    
    $acara = new Acara('','','','','','','','', '');
    $posterFileName = $acara->uploadPoster('poster');
    $acaraWithPoster = new Acara($title, $event_type_id, $venue_id, $start_date, $end_date,  $description, $status,$posterFileName, $price);
    $acaraWithPoster->addEvent($pdo);
}


// Hapus Event
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    if (is_numeric($delete_id)) {
        $acara = new Acara('','','','','','','','', ''); 
        $acara->deleteEvent($pdo, $delete_id);
    } else {
        echo "ID tidak valid.";
    }
}

// Pencarian Event
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM vw_events_data WHERE title LIKE ?";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . $search . '%']);
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - DAFTAR ACARA</title>

    <style>
        .custom-card-img {
            width: 100%;
            height: 200px;
            /* Tentukan tinggi gambar agar persegi */
            object-fit: cover;
            /* Gambar akan tetap terpotong untuk mengisi area */
        }
    </style>
</head>
<body>
    
</body>
</html>
<div class="container-fluid">
    <h2 class="text-center mb-4">Manajemen Events</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <!-- Form Pencarian dan Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex" style="flex-grow: 1;">
            <input type="text" name="search" autofocus="true" class="form-control me-2" placeholder="Cari event..." value="<?= htmlspecialchars($search) ?>">
        </form>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">Tambah Event</button>
    </div>

    <!-- card events -->
    <div class='row'>
    <?php foreach($events as $event):?>
        <?php if ($event["status_aktif"] == TRUE):?>
        <div class="col-md-4">
            <div class="card">
                <img src="../uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>" class="custom-card-img card-img-top" alt="<?= htmlspecialchars($event['title']) ?>">
                <div class="card-body"> 
                    <h5 class="card-title">
                        <strong><?=htmlspecialchars($event['title'])?></strong>
                    </h5> <br>
                <p class="card-text">
                    <strong>Tanggal:</strong>
                    <?= date('l, jS F Y H:i', strtotime($event['start_date'])) ?> 
                        <?php if (!empty($event['end_date'])): ?>
                            - <?= date('l, jS F Y H:i', strtotime($event['end_date'])) ?>
                        <?php endif; ?> <br>
                    <strong>Tipe Acara:</strong>
                    <?=htmlspecialchars($event['event_type_name'])?> <br>
                    <strong>Lokasi:</strong>
                    <?=htmlspecialchars($event['venue_name'])?> <br>
                    <strong>Status:</strong>
                    <?=htmlspecialchars($event['status_acara'])?> <br>
                </p>
                    <a href="../admin/pages/event_detail.php?id=<?= $event['event_ID'] ?>" class="btn btn-primary">Lihat Event</a>
                </div>
            </div>
        </div>
        <?php endif?>
    <?php endforeach?>


<!-- Modal Tambah Event -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="event_type_id" class="form-label">Tipe Event</label>
                        <input type="number" class="form-control" id="event_type_id" name="event_type_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="venue_id" class="form-label">Venue ID</label>
                        <input type="number" class="form-control" id="venue_id" name="venue_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" class="form-control" id="poster" name="poster">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">HTM</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>