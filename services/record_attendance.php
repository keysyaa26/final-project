<?php
session_start();
include '../includes/config.php';

// Ambil data dari request JSON
$data = json_decode(file_get_contents("php://input"), true);

// ini kebalik
$event_id = (int)$data['event_id'];
$registration_id = (int)$data['registration_id'];

echo "Registration ID: " . $registration_id . "</br>";
echo "Event ID: " . $event_id . "</br>";

// die;

if (!isset($data['registration_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID registrasi tidak ditemukan.']);
    exit;
}



// validasi data registrasi
$stmt = $pdo->prepare("SELECT * FROM event_ticket_assignment WHERE attendee_ID = ? AND event_ID = ?");
$stmt->execute([$event_id, $registration_id]);
$registration_data = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$registration_data) {
    echo json_encode(['status' => 'error', 'message' => 'Registrasi tidak ditemukan.']);
    exit;
}


// update status kehadiran
$stmt = $pdo->prepare("UPDATE event_ticket_assignment SET attendance_status = 'Hadir' WHERE attendee_ID = ? AND event_ID = ?");

$registration_data= $stmt->execute([$event_id, $registration_id]);

echo json_encode(['status' => 'success', 'message' => 'Kehadiran berhasil dicatat.']);

exit;
?>
