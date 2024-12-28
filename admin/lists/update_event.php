<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require "../../includes/config.php";
include '../../src/Acara.php';

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Acara tidak ditemukan.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $event_type_id = $_POST['event_type_id'];
    $venue_id = $_POST['venue_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE events SET title = ?, event_type_ID = ?, venue_ID = ?, start_date =?, end_date =?, description =?, price=?, status_acara =? WHERE event_ID = ?");
    
    if ($stmt->execute([$title, $event_type_id, $venue_id, $start_date, $end_date,  $description, $price, $status, $event_id]))
    {
    $updateSuccess = true; // Set flag to true if update is successful
        }

    header("Location: event_detail.php?id=" . $event_id);
    exit;
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Acara</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Acara <?= htmlspecialchars($event['title']) ?></h2>
    <form method="POST">
        <input type="hidden" name="event_id" value="<?= $event['event_ID'] ?>">

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul Acara</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
        </div>

        <!-- Event Type -->
         <div class="mb-3">
            <label for="event_type_id" class="form-label">Jenis Acara</label>
                <select class="form-select" id="event_type_id" name="event_type_id" required>
                    <!-- data event_type -->
                    <?php
                    $query = "SELECT * FROM event_type";
                    $stmt = $pdo->query($query);
                    $event_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($event_types as $event_type):
                    ?>
                        <option value="<?= $event_type['event_type_ID'] ?>" 
                            <?= isset($selected_event_type) && $selected_event_type == $event_type['event_type_ID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($event_type['event_type_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
        </div>

        <!-- Venue -->
         <div class="mb-3">
            <label for="event_type_id" class="form-label">Tempat acara</label>
                <select class="form-select" id="venue_id" name="venue_id" required>
                    <!-- data event_venue -->
                    <?php
                    $query = "SELECT venue.* FROM venue";
                    $stmt = $pdo->query($query);
                    $event_venues = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($event_venues as $event_venue):
                    ?>
                        <option value="<?= $event_venue['venue_ID'] ?>" 
                            <?= isset($selected_event_venue) && $selected_event_venue == $event_venue['venue_ID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($event_venue['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
        </div>
        

        <!-- Start Date -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?= date('Y-m-d\TH:i', strtotime($event['start_date'])) ?>" required>
        </div>

        <!-- End Date -->
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Selesai</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?= date('Y-m-d\TH:i', strtotime($event['end_date'])) ?>" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Acara</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($event['description'])?></textarea>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <?php
                // Array enum status
                $statusOptions = ['UPCOMING', 'ON GOING', 'COMPLETED'];

                foreach ($statusOptions as $status):
                ?>
                    <option value="<?= $status ?>" 
                        <?= $event['status_acara'] == $status ? 'selected' : '' ?>>
                        <?= htmlspecialchars($status) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">HTM</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($event['price']); ?>" required>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<!-- Link ke JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
