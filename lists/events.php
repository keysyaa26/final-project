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
    $event_id = $_POST['event_id'] ?? null;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $status = $_POST['status'] ?? 'upcoming';  // Default status adalah 'upcoming'
    
    $acara = new Acara($title, $description, $date, $location);
    $posterFileName = $acara->uploadPoster('poster');
    $acaraWithPoster = new Acara($title, $description, $date, $location, $status, $posterFileName);
    if($event_id) {
        $acaraWithPoster->setDetailEvent($title, $description, $date, $location, $status, $posterFileName);
        $acaraWithPoster->editEvent($pdo);
    } else {
        $acaraWithPoster->addEvent($pdo);
    }
}


// Hapus Event
if (isset($_GET['delete_id'])) {
    // panggil method
    $delete_id = $_GET['delete_id'];
    $acara = new Acara('', '', '', null, '');
    $acara->deleteEvent($pdo, $delete_id);
}

// Pencarian Event
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM vw_events_data WHERE title LIKE ?";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . $search . '%']);
$events = $stmt->fetchAll();
?>


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

<div class="col-md-4">
    <div class="card">
        <img src="../uploads/<?=htmlspecialchars($event['poster']) ? htmlspecialchars($studio['foto']) :'default.jpg'?>" alt="Foto Studio" class="mt-3">
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
            <?=htmlspecialchars($event['status'])?> <br>
        </p>
    </div>
        <div class="text-center pb-2 p-3 alert-info">
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="../update/update_studio.php?studio_id=<?php echo $studio['studio_id'];?>"
                    class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="../delete/delete_studio.php?studio_id=<?php echo $studio['studio_id'];?>"
                    class="btn btn-warning"><i class="fa fa-trash"></i></a>
            <?php endif;?>
        </div>
    </div>
    </div>
    <?php endforeach?>


<!-- Modal Tambah Event -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" enctype="multipart/form-data"> <!-- Menambahkan enctype untuk upload file -->
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Tambah Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Event</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Poster</label>
                    <input type="file" name="poster" id="poster" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit Event -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="event_id" id="edit-event-id">
                <div class="mb-3">
                    <label class="form-label">Judul Event</label>
                    <input type="text" name="title" class="form-control" id="edit-event-title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" id="edit-event-description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" id="edit-event-date" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Poster</label>
                    <input type="file" name="poster" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mengisi data di modal edit event
    document.addEventListener('DOMContentLoaded', function () {
        const editEventModal = document.getElementById('editEventModal');
        editEventModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol yang memicu modal
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const date = button.getAttribute('data-date');

            // Isi data di modal
            document.getElementById('edit-event-id').value = id;
            document.getElementById('edit-event-title').value = title;
            document.getElementById('edit-event-description').value = description;
            document.getElementById('edit-event-date').value = date;
        });
    });
</script>

<?php include '../includes/footer.php'; ?>