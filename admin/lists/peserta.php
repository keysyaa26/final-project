<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

require __DIR__ . '/../../includes/config.php';
require __DIR__ . '/../../includes/admin/header.php';

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch();
} else {
    echo "Event tidak ditemukan.";
    exit;
}

$search = trim($_GET['search'] ?? '');
$query = "SELECT * FROM vw_attendee_data WHERE LOWER(name) LIKE LOWER(?) AND transaction_status = 'Success' AND event_ID = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(['%' . strtolower($search) . '%', $event_id]);
$participants = $stmt->fetchAll();

?>

<div class="container-fluid">
    <h2 class="text-center mb-4">Manajemen Peserta Acara</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <!-- Form Pencarian -->
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" class="d-flex" style="flex-grow: 1;">
        <input type="text" name="search" autofocus="true" class="form-control me-2" placeholder="Cari peserta..." value="<?= htmlspecialchars($search) ?>">
        </form>

        <!-- Link Kembali -->
        <a href="../dashboard.php" class="btn btn-primary" style="margin: 5px">Back</a>
    </div>

    <!-- Tabel Daftar Peserta -->
    <table class="table table-striped">
        <?php if (count($participants) > 0): ?>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>QR Code</th>
                    <th>Status Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $participant): ?>
                    <?php if ($participant['event_ID'] == $event_id) :?>
                        <tr>
                            <td><?= htmlspecialchars($participant['name']) ?></td>
                            <td><?= htmlspecialchars($participant['email']) ?></td>
                            <td><?= htmlspecialchars($participant['phone']) ?></td>
                            <td><a href="../../assets/uploads/qr_code/<?= $participant['QR_code'] ? $participant['QR_code']: 'default.jpg' ?>">Lihat QR Code</a></td>
                            <td><?= htmlspecialchars($participant['attendance_status']) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
                <?php else: ?>
                    <p>Tidak ada peserta yang terdaftar untuk event ini.</p>
                <?php endif; ?>
    </table>
</div>

<?php require __DIR__ . '/../../includes/admin/footer.php'; ?>