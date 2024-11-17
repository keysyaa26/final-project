<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../includes/header.php'; // Navbar dan sidebar
?>

<div class="container-fluid">
    <h2 class="text-center mb-4">Halaman Sertifikat</h2>
    <p>Konten untuk manajemen sertifikat akan ditambahkan di sini.</p>
</div>

<?php include '../includes/footer.php'; ?>
