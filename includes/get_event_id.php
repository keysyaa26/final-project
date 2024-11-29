<?php
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