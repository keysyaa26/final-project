<?php
include '../includes/config-key.php';

// Path template sertifikat yang di-upload
$templatePath = 'templates/' . basename($_FILES['template_sertifikat']['name']);
$outputFolder = 'output_sertifikat/';

// Memastikan template ada
if (!file_exists($templatePath)) {
    die("Template sertifikat tidak ditemukan.");
}

// Ambil data peserta dari database
$sql = "SELECT id_peserta, nama_peserta, email_peserta FROM peserta";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pesertaData = $stmt->fetchAll();

foreach ($pesertaData as $peserta) {
    $nama = $peserta['nama_peserta'];
    $email = $peserta['email_peserta'];
    
    // Membuat sertifikat untuk peserta ini
    $outputFile = $outputFolder . "sertifikat_" . $peserta['id_peserta'] . ".png";
    createCertificateFromImage($templatePath, $outputFile, $nama);

    // Simpan data sertifikat ke database
    $sql = "INSERT INTO sertifikat (peserta_id, nama_file) 
            VALUES (:peserta_id, :nama_file)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'peserta_id' => $peserta['id_peserta'],
        'nama_file' => $outputFile
    ]);
}

echo "Sertifikat berhasil dibuat dan disimpan di database!<br>";

// Fungsi untuk membuat sertifikat
function createCertificateFromImage($templatePath, $outputPath, $name) {
    // Membaca file template gambar
    $image = imagecreatefrompng($templatePath);

    // Menentukan warna teks (hitam)
    $textColor = imagecolorallocate($image, 0, 0, 0);

    // Tentukan path font yang akan digunakan untuk menulis nama peserta
    $fontPath = 'assets/fonts/font.ttf';  // Ganti dengan path ke font yang sesuai
    $fontSize = 20;

    // Menambahkan nama peserta ke dalam gambar sertifikat
    imagettftext($image, $fontSize, 0, 200, 300, $textColor, $fontPath, $name);

    // Simpan gambar sebagai sertifikat PNG
    imagepng($image, $outputPath);
    imagedestroy($image);
}
?>
