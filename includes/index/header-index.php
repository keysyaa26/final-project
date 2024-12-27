<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="icon" href="https://1378-182-253-128-32.ngrok-free.app/final-project/assets/img/logo_bprotic.png">
    <title>Landing Page</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #191970;
            position: absolute;
            width: 100%;
            z-index: 10;
        }

        html {
            scroll-behavior: smooth;
        }
        
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <?php
    $current_page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file saat ini
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Brand -->
            <img src="https://1378-182-253-128-32.ngrok-free.app/final-project/assets/img/logo-bprotic.png" alt="BPROTIC Logo"
                style="height: 40px; width: auto; margin-right: 10px;">
            <a class="navbar-brand" href="https://1378-182-253-128-32.ngrok-free.app/final-project/index.php" style="font-weight: bold;">BPROTIC</a>>

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
                            href="https://1378-182-253-128-32.ngrok-free.app/final-project/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'all_events.php') ? 'active' : '' ?>"
                            href="https://1378-182-253-128-32.ngrok-free.app/final-project/user/all_events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://1378-182-253-128-32.ngrok-free.app/final-project/index.php#contact">Contact</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

</html>