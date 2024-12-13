<!--HEADER -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="icon" href="img/logo_bprotic.png">
    <title>Landing Page</title>
    <style>
        .custom-btn {
            background-color: #C92127;
            border-color: #C92127;
            color: white;
        }

        .custom-btn:hover {
            background-color: #a51b20;
            border-color: #a51b20;
        }

        .row {
            justify-content: center;
            /* Agar card tetap rapi di tengah */
            gap: 20px;
            /* Menambahkan jarak antar card */
        }

        .card {
            margin: 15px;
        }

        .custom-card-img {
            width: 100%;
            height: 250px;
            /* Tentukan tinggi gambar agar persegi */
            object-fit: cover;
            /* Gambar akan tetap terpotong untuk mengisi area */
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Font Poppins */
            padding-top: 70px;
            /* Sesuaikan dengan tinggi navbar */

        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            /* Bisa diubah sesuai kebutuhan */
        }

        h1,
        h2,
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            /* Untuk heading bisa lebih tebal */
        }

        html {
            scroll-behavior: smooth;
            /* Efek scroll halus */
        }
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <?php
    $current_page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file saat ini
    ?>

    <nav class="navbar navbar-dark navbar-expand-lg fixed-top" style="background-color: #2C2C7C;">
        <div class="container-fluid">
            <!-- Brand -->
            <img src="../../assets/img/logo-bprotic.png" alt="BPROTIC Logo"
                style="height: 40px; width: auto; margin-right: 10px;">
            <a class="navbar-brand" href="#" style="font-weight: bold;">BPROTIC</a>
            <!-- Toggler Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>"
                            href="bprotic_event/index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'events.php') ? 'active' : '' ?>"

                            href="user/all_events.php">EVENTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#social-media">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</html>