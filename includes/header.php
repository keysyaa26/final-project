<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            font-size: 16px;
            color: #333;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #e2e6ea;
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo Website -->
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../assets/img/logo-bprotic.png" alt="Logo" width="40" height="40" class="me-2">
                <span>BPROTIC</span>
            </a>
            <!-- Toggle button untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu Navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- Logout button -->
                        <form action="../admin/logout.php" method="POST">
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h5 class="text-center">Menu</h5>
                <a href="../admin/dashboard.php">Dashboard</a>
                <a href="../lists/events.php">Events</a>
                <a href="../list/peserta.php">Peserta</a>
                <a href="scan_qr.php">Scan QR</a>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-9 col-lg-10 pt-4">
                <!-- Konten halaman akan dimasukkan di sini -->
