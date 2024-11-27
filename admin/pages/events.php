<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../../src/Acara.php';
include '../../includes/header.php';
include '../../includes/config.php';

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
$query = "SELECT * FROM events WHERE title LIKE ?";
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
            <input type="text" name="search" class="form-control me-2" placeholder="Cari event..." value="<?= htmlspecialchars($search) ?>">
        </form>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">Tambah Event</button>
    </div>

    <!-- Tabel Daftar Events -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Poster</th> <!-- Kolom baru untuk menampilkan poster -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $event['id'] ?></td>
                <td><?= htmlspecialchars($event['title']) ?></td>
                <td><?= htmlspecialchars($event['description']) ?></td>
                <td><?= $event['date'] ?></td>
                <td>
                    <!-- Menampilkan link ke poster atau gambar jika ada -->
                    <?php if ($event['poster']): ?>
                        <a href="../../assets/img/poster/<?= $event['poster'] ?>" target="_blank">Lihat Poster</a>
                    <?php else: ?>
                        Tidak ada poster
                    <?php endif; ?>
                </td>
                <td>
                    <!-- tombol edit -->
                    <button class="btn btn-sm btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editEventModal" 
                            data-id="<?= $event['id'] ?>" 
                            data-title="<?= htmlspecialchars($event['title']) ?>" 
                            data-description="<?= htmlspecialchars($event['description']) ?>" 
                            data-date="<?= $event['date'] ?>"
                            data-poster="<?= $event['poster'] ?>">
                        Edit
                    </button>

                    <!-- tombol hapus -->
                    <a href="events.php?delete_id=<?= $event['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus event ini?')">Hapus</a>

                    <!-- tombol peserta -->
                     <!-- Tombol Lihat Peserta -->
                    <a href="peserta.php?event_id=<?= $event['id'] ?>" class="btn btn-sm btn-info">
                        Lihat Peserta
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


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

<?php include '../../includes/footer.php'; ?>