<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require __DIR__ . '/../includes/admin/header.php';
require __DIR__ . '/../includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container-fluid">
    <h2 class="text-center mb-4">Scan QR Code Peserta</h2>
    <div id="qr-reader" style="width: 500px; margin: auto;"></div>
    <p id="result" class="mt-3 text-center">Hasil scan akan muncul di sini.</p>
</div>

<script src="../assets/js/html5-qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function onScanSuccess(decodedText) {
        console.log(`Hasil scan: ${decodedText}`);  // Tambahkan ini untuk debugging

        // Ambil data dari QR code
        let [registration_id, event_id] = decodedText.split(":");

        // Cek apakah data valid
        if (!registration_id || !event_id || isNaN(registration_id) || isNaN(event_id)) {
            document.getElementById('result').innerText = 'QR code tidak valid atau tidak lengkap.';
            return;
        }

        // Kirim data ke server
        fetch('../services/record_attendance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ registration_id, event_id })
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerText = data;

            Swal.fire({
                icon: 'success',
                title: 'Scan Sukses!',
                text: 'Kehadiran berhasil tercatat.',
                showConfirmButton: false,
                timer: 2000
            });
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerText = 'Error mencatat kehadiran.';

            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Kehadiran gagal tercatat.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    }

    function onScanFailure(error) {
        // Jika scan gagal, Anda bisa mengabaikannya atau menampilkan pesan
        console.warn(`QR Code scan error: ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
</body>
</html>

<?php require __DIR__ . '/../includes/admin/header.php'; ?>