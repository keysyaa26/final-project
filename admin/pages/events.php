<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/config.php';

$error_message = '';
$message = '';

// Tambah atau Edit Event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $event_type_id = intval($_POST['event_type_id']);
    $venue_id = intval($_POST['venue_id']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = trim($_POST['description']);
    $status = trim($_POST['status']);
    $event_id = $_POST['event_id'] ?? null;

    // Ambil poster lama jika tidak ada file baru
    $poster = null;
    if ($event_id) {
        $stmt = $pdo->prepare("SELECT poster FROM events WHERE event_ID = ?");
        $stmt->execute([$event_id]);
        $poster = $stmt->fetchColumn();
    }

    // Validasi upload file gambar
    if (!empty($_FILES['poster']['name'])) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_name = $_FILES['poster']['name'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_size = $_FILES['poster']['size'];
        $max_file_size = 2 * 1024 * 1024;

        if (!in_array($file_extension, $allowed_extensions)) {
            $error_message = "Format file tidak valid. Gunakan jpg, jpeg, atau png.";
        } elseif ($file_size > $max_file_size) {
            $error_message = "Ukuran file terlalu besar. Maksimum 2MB.";
        } else {
            $new_file_name = uniqid() . '.' . $file_extension;
            $upload_path = "../assets/images/" . $new_file_name;
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $upload_path)) {
                $poster = $new_file_name;
            } else {
                $error_message = "Gagal mengunggah file.";
            }
        }
    }

    // Proses hanya jika tidak ada error
    if (empty($error_message)) {
        if ($event_id) {
            // Edit event
            $query = "UPDATE events SET title = ?, event_type_ID = ?, venue_ID = ?, start_date = ?, end_date = ?, description = ?, poster = ?, status = ? WHERE event_ID = ?";
            $params = [$title, $event_type_id, $venue_id, $start_date, $end_date, $description, $poster, $status, $event_id];
            $message = "Event berhasil diperbarui.";
        } else {
            // Tambah event baru
            $query = "INSERT INTO events (title, event_type_ID, venue_ID, start_date, end_date, description, poster, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [$title, $event_type_id, $venue_id, $start_date, $end_date, $description, $poster, $status];
            $message = "Event berhasil ditambahkan.";
        }

        $stmt = $pdo->prepare($query);
        if ($stmt->execute($params)) {
            header("Location: events.php?message=" . urlencode($message));
            exit;
        } else {
            $error_message = "Terjadi kesalahan. Coba lagi.";
        }
    }
}

// Hapus Event
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $pdo->prepare("SELECT poster FROM events WHERE event_ID = ?");
    $stmt->execute([$delete_id]);
    $poster = $stmt->fetchColumn();

    if ($poster && file_exists("../assets/images/" . $poster)) {
        unlink("../assets/images/" . $poster);
    }

    $stmt = $pdo->prepare("DELETE FROM events WHERE event_ID = ?");
    $stmt->execute([$delete_id]);
    header("Location: events.php?message=" . urlencode("Event berhasil dihapus."));
    exit;
}

// Pencarian Event
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM events WHERE title LIKE ? ORDER BY start_date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . $search . '%']);
$events = $stmt->fetchAll();
?>

<div class="container-fluid">
    <h2 class="text-center mb-4">Manajemen Events</h2>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Form Pencarian dan Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex" style="flex-grow: 1;">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari event..." value="<?= htmlspecialchars($search) ?>">
        </form>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">Tambah Event</button>
    </div>

    <!-- Kartu Events -->
    <div class="row">
        <?php foreach ($events as $event): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <?php if ($event['poster']): ?>
                    <img src="../assets/images/<?= htmlspecialchars($event['poster']) ?>" class="card-img-top" alt="Poster Event">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                    <p><?= htmlspecialchars($event['description']) ?></p>
                    <p><strong>Mulai:</strong> <?= $event['start_date'] ?></p>
                    <p><strong>Selesai:</strong> <?= $event['end_date'] ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($event['status']) ?></p>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal"
                            data-id="<?= $event['event_ID'] ?>"
                            data-title="<?= htmlspecialchars($event['title']) ?>"
                            data-event_type_id="<?= $event['event_type_ID'] ?>"
                            data-venue_id="<?= $event['venue_ID'] ?>"
                            data-start_date="<?= $event['start_date'] ?>"
                            data-end_date="<?= $event['end_date'] ?>"
                            data-description="<?= htmlspecialchars($event['description']) ?>"
                            data-poster="<?= htmlspecialchars($event['poster']) ?>"
                            data-status="<?= htmlspecialchars($event['status']) ?>">Edit</button>
                    <a href="events.php?delete_id=<?= $event['event_ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')">Hapus</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Event -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="event_ID" id="edit-event-id">
                <div class="mb-3">
                    <label for="edit-title" class="form-label">Judul Event</label>
                    <input type="text" class="form-control" id="edit-title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="edit-event-type-id" class="form-label">Event Type ID</label>
                    <input type="number" class="form-control" id="edit-event-type-id" name="event_type_ID" required>
                </div>
                <div class="mb-3">
                    <label for="edit-venue-id" class="form-label">Venue ID</label>
                    <input type="number" class="form-control" id="edit-venue-id" name="venue_ID" required>
                </div>
                <div class="mb-3">
                    <label for="edit-start-date" class="form-label">Tanggal Mulai</label>
                    <input type="datetime-local" class="form-control" id="edit-start-date" name="start_date" required>
                </div>
                <div class="mb-3">
                    <label for="edit-end-date" class="form-label">Tanggal Selesai</label>
                    <input type="datetime-local" class="form-control" id="edit-end-date" name="end_date" required>
                </div>
                <div class="mb-3">
                    <label for="edit-description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="edit-poster" class="form-label">Poster Event (kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" class="form-control" id="edit-poster" name="poster">
                </div>
                <div class="mb-3">
                    <label for="edit-status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="edit-status" name="status" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Javascript -->
<script>
const editEventModal = document.getElementById('editEventModal');
editEventModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget; // Tombol yang membuka modal
    const id = button.getAttribute('data-id');
    const title = button.getAttribute('data-title');
    const eventTypeID = button.getAttribute('data-event-type-id');
    const venueID = button.getAttribute('data-venue-id');
    const startDate = button.getAttribute('data-start-date');
    const endDate = button.getAttribute('data-end-date');
    const description = button.getAttribute('data-description');
    const status = button.getAttribute('data-status');

    document.getElementById('edit-event-id').value = id;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-event-type-id').value = eventTypeID;
    document.getElementById('edit-venue-id').value = venueID;
    document.getElementById('edit-start-date').value = startDate;
    document.getElementById('edit-end-date').value = endDate;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-status').value = status;
});
</script>


<?php include '../../includes/footer.php'; ?>
