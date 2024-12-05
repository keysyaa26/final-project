<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
    exit;
}

include '../includes/header.php';
include '../includes/config.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">
            <h5 class="text-center">Menu</h5>
            <a href="../admin/dashboard.php">Dashboard</a>
            <a href="../lists/events.php">Events</a>
            <a href="../lists/peserta.php">Peserta</a>
            <a href="scan_qr.php">Scan QR</a>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9 col-lg-10 ms-auto">
            <h2 class="text-center mb-4">Dashboard Admin</h2>
            <div class="row justify-content-center">
                <!-- Events Menu -->
                <div class="col-md-4">
                    <div class="card text-center mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Acara</h5>
                            <p class="card-text">Lihat dan kelola daftar acara.</p>
                            <a href="../lists/events.php" class="btn btn-primary">Go to Events</a>
                        </div>
                    </div>
                </div>

                <!-- Peserta Menu -->
                <div class="col-md-4">
                    <div class="card text-center mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Peserta</h5>
                            <p class="card-text">Lihat dan kelola daftar peserta.</p>
                            <a href="../lists/peserta.php" class="btn btn-primary">Go to Peserta</a>
                        </div>
                    </div>
                </div>

                <!-- Scan QR Menu -->
                <div class="col-md-4">
                    <div class="card text-center mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Scan QR</h5>
                            <p class="card-text">Scan tiket peserta untuk kehadiran.</p>
                            <a href="scan_qr.php" class="btn btn-primary">Go to Scan QR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; // Penutup halaman ?>