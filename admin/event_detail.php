<?php
include '../includes/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    echo "Event tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Event - <?= htmlspecialchars($event['title']) ?></title>
</head>
<body>
    <h2><?= htmlspecialchars($event['title']) ?></h2>
    <?php if (!empty($event['image'])): ?>
        <img src="../assets/uploads/<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" width="300">
    <?php endif; ?>
    <p><?= htmlspecialchars($event['description']) ?></p>
    <p>Tanggal: <?= $event['date'] ?></p>
    <a href="../register_event.php?event_id=<?= $event['id'] ?>">Daftar Sekarang</a>
</body>
</html>
