<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
    exit;
}

include '../includes/admin/header.php';
include '../includes/config.php';

// ambil untuk upcoming event
$query = "
    SELECT * FROM vw_events_data
    WHERE vw_events_data.start_date >= CURDATE() AND status_aktif = 1
    ORDER BY vw_events_data.start_date ASC
    LIMIT 1
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll();

// untuk countdown
$eventDate = $events[0]["start_date"];
$timeStamp = strtotime($eventDate);
$currentTime = time();
$remainingTime = $timeStamp - $currentTime;

if ($remainingTime <= 0) {
    $remainingTime = 0;
}

$days = floor($remainingTime / (60 * 60 * 24));
$hours = floor(($remainingTime % (60 * 60 * 24)) / (60 * 60));
$minutes = floor(($remainingTime % (60 * 60)) / 60);
$seconds = $remainingTime % 60;
$countdown = sprintf('%02d:%02d:%02d:%02d', $days, $hours, $minutes, $seconds);


// menghitung peserta terdaftar
$event_id = $events[0]['event_ID'];
$query = "SELECT COUNT(attendee_ID) FROM event_ticket_assignment WHERE event_ID = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $event_id, PDO::PARAM_INT);
$stmt->execute();
$attendee_row = $stmt->fetchColumn();

$venue_id = $events[0]['venue_ID'];
$query = "SELECT capacity FROM venue WHERE venue_ID = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $venue_id, PDO::PARAM_INT);
$stmt->execute();
$venue_capacity = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Panitia Acara Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ8v9rN5Qccv4V2hR1iYvZf3xw2qfJwWsT7ccxflHCEV1r5x3tG7waGbT2C5E" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .countdown-timer {
            font-size: 2rem;
            font-weight: bold;
        }
        .participant-count {
            font-size: 2rem;
            font-weight: bold;
        }
        .agenda-calendar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .agenda-item {
            margin-bottom: 10px;
        }

        .center-text {
            text-align: center;
        }

    </style>
</head>
<body>

<div class="container-fluid mt-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Welcome message -->
            <h2 class="text-center">Selamat Datang, Admin!</h2>

            <!-- Upcoming Event Section -->
            <div class="mt-4">
                <h3>Acara yang akan datang</h3> <br>
                <h2 class="text-center"> <?php echo htmlspecialchars($events[0]["title"])?> </h2>
            
                <div class="row">
                    <!-- Left: Countdown -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>Countdown</h4>
                                <div id="countdown" class="countdown-timer"><?php echo $countdown; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Participant Count -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                            <h4><a href="lists/peserta.php?id=<?=$event_id?>">Jumlah Peserta Terdaftar </a></h4>

                                <?php if ($venue_capacity > 0) { 
                                    $percentage = ($attendee_row / $venue_capacity) * 100;
                                    $percentage = number_format($percentage, 2); 
                                ?>
                                    <div id="participant-count" class="participant-count">
                                        <?php echo htmlspecialchars($percentage);?>%
                                    </div>
                                <?php } else { ?>
                                    <div id="participant-count" class="participant-count">
                                        <?php echo htmlspecialchars($attendee_row); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Section -->
            <div class="mt-5">
                <h3>Agenda Acara</h3>
                <div class="agenda-calendar">
                    <div class="agenda-item">
                        <strong>Acara 1 - Seminar Pengenalan Teknologi</strong>
                        <br>
                        <span class="text-muted">Tanggal: 15 Desember 2024</span>
                    </div>
                    <div class="agenda-item">
                        <strong>Acara 2 - Workshop Pemrograman Web</strong>
                        <br>
                        <span class="text-muted">Tanggal: 20 Desember 2024</span>
                    </div>
                    <div class="agenda-item">
                        <strong>Acara 3 - Sesi Tanya Jawab & Penutupan</strong>
                        <br>
                        <span class="text-muted">Tanggal: 25 Desember 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        // Jika Anda ingin timer dihitung mundur secara real-time, tambahkan JavaScript
        let countdownElement = document.getElementById('countdown');
        
        function updateCountdown() {
            let targetDate = new Date("<?php echo $eventDate; ?>").getTime();
            let currentDate = new Date().getTime();
            let timeRemaining = targetDate - currentDate;

            if (timeRemaining <= 0) {
                countdownElement.innerHTML = "00:00:00";
                clearInterval(countdownInterval);
                return;
            }

            let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days}:${hours < 10 ? '0' + hours : hours}:${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        }

        // Update countdown every second
        let countdownInterval = setInterval(updateCountdown, 1000);

</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../includes/admin/footer.php'; // Penutup halaman ?>
