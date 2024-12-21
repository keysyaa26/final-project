<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
    exit;
}

require __DIR__ .  '/../includes/admin/header.php';
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../src/Acara.php';

// ambil untuk upcoming event
$acara = new Acara();
$events = $acara->tampilkanAcara($pdo, $limit = 3, $all = false);


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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ8v9rN5Qccv4V2hR1iYvZf3xw2qfJwWsT7ccxflHCEV1r5x3tG7waGbT2C5E" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .countdown-timer {
            font-size: 2rem;
            font-weight: bold;
            color: #d9534f;
        }

        .participant-count {
            font-size: 2rem;
            font-weight: bold;
            color: #5bc0de;
        }

        .agenda-calendar {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .agenda-item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .card-body {
            background-color: #ffffff;
            color: #333;
        }

        .card-footer {
            background-color: #f8f9fa;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-secondary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .shadow-lg {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        hr {
            border: 1px solid #6c757d;
            /* Warna abu-abu, bisa diganti dengan hitam (#000) */
            margin-top: 50px;
            /* Jarak atas */
            margin-bottom: 30px;
            /* Jarak bawah */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container mt-5">
            <div class="text-center fs-1">
                <h2>Selamat Datang, Admin!</h2>
            </div>
        </div>
        <hr>
        <div class="container">
            <h3 class="text-center mt-5 text-primary">Acara yang akan datang</h3>
            <h2 class="text-center"> <?php echo htmlspecialchars($events[0]["title"])?> </h2>
            <div class="row justify-content-center">
                <!-- Countdown -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h5>Countdown</h5>
                        </div>
                        <div class="card-body text-center">
                            <div id="countdown" class="fs-4 fw-bold">Loading...</div>
                        </div>
                    </div>
                </div>

                <!-- Participant Count -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h5><a href="lists/peserta.php?id=<?=$event_id?>">Jumlah Peserta Terdaftar </a></h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="fs-4 fw-bold"><?php if ($venue_capacity > 0) { 
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
                                <?php } ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Section -->
            <div class="mt-5">
                <h3 class="text-center text-primary">Agenda Acara</h3>
                <div class="agenda-calendar">
                    <div class="agenda-item">
                        <strong>Acara 1 - Seminar Pengenalan Teknologi</strong><br>
                        <span class="text-muted">Tanggal: 15 Desember 2024</span>
                    </div>
                    <div class="agenda-item">
                        <strong>Acara 2 - Workshop Pemrograman Web</strong><br>
                        <span class="text-muted">Tanggal: 20 Desember 2024</span>
                    </div>
                    <div class="agenda-item">
                        <strong>Acara 3 - Sesi Tanya Jawab & Penutupan</strong><br>
                        <span class="text-muted">Tanggal: 25 Desember 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Menu Section -->
    <div class="container">
        <h2 class="text-center mt-5 mb-4 text-primary">Dashboard Admin</h2>
        <div class="row justify-content-center">
            <!-- Events Menu -->
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Acara</h5>
                        <p class="card-text">Lihat dan kelola daftar acara.</p>
                        <a href="../lists/events.php" class="btn btn-primary">Go to Events</a>
                    </div>
                </div>
            </div>

            <!-- Peserta Menu -->
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Peserta</h5>
                        <p class="card-text">Lihat dan kelola daftar peserta.</p>
                        <a href="../lists/peserta.php" class="btn btn-primary">Go to Peserta</a>
                    </div>
                </div>
            </div>

            <!-- Scan QR Menu -->
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Scan QR</h5>
                        <p class="card-text">Scan tiket peserta untuk kehadiran.</p>
                        <a href="scan_qr.php" class="btn btn-primary">Go to Scan QR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Countdown Timer Script
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


<?php require __DIR__ .  '/../includes/admin/footer.php'; ?>