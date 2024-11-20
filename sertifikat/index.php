<?php
session_start();
include '../includes/config-key.php';

// Menangani proses upload template
if (isset($_POST['submit_template'])) {
    if (isset($_FILES['template_sertifikat']) && $_FILES['template_sertifikat']['error'] == 0) {
        $templateFile = $_FILES['template_sertifikat'];
        $targetDirectory = 'templates/';
        $templatePath = $targetDirectory . basename($templateFile['name']);
        
        if (move_uploaded_file($templateFile['tmp_name'], $templatePath)) {
            echo "Template sertifikat berhasil diupload!<br>";

            // Setelah template berhasil di-upload, proses pembuatan sertifikat
            include 'proses.php';
        } else {
            echo "Gagal mengupload template sertifikat.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Template Sertifikat</title>
</head>
<body>
    <h1>Upload Template Sertifikat</h1>

    <!-- Form untuk Upload Template Sertifikat -->
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="template_sertifikat">Upload Template Sertifikat (PNG):</label>
        <input type="file" name="template_sertifikat" required><br><br>
        <input type="submit" name="submit_template" value="Upload Template">
    </form>

</body>
</html>
