<?php
require __DIR__ . '/../../includes/config.php';
require __DIR__ . '/../../includes/admin/header.php';

// Validasi nilai ID
$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($event_id) {
    $query = "SELECT events.*, CONCAT(venue.name, ', ', venue.addres_line) AS venue_name
                FROM events
                JOIN venue ON events.venue_ID = venue.venue_ID
                WHERE event_ID = :event_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT); // Bind parameter
    $stmt->execute();
    $event = $stmt->fetch();
} else {
    echo "Event tidak ditemukan.";
    exit;
}

// Hapus Event
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    if (is_numeric($delete_id)) {
        $acara = new Acara('','','','','','','','', ''); 
        $acara->hapusAcara($pdo, $delete_id);
    } else {
        echo "ID tidak valid.";
    }
}

// hitung peserta

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Details Event Page</title>

    <style>
        .custom-img {
            width: 200px;
            /* Anda bisa mengatur ukuran sesuai kebutuhan */
            height: auto;
        }

        /* Container untuk gambar acara */
        .img-container {
            display: flex;
            /* Menggunakan flexbox untuk tata letak */
            justify-content: center;
            /* Menyusun gambar di tengah horizontal */
            align-items: center;
            /* Menyusun gambar di tengah vertikal jika diperlukan */
            height: 400px;
            /* Menentukan tinggi container, sesuaikan jika diperlukan */
            margin-bottom: 20px;
            /* Memberikan jarak di bawah gambar */
        }

        /* Gambar acara */
        .event-img {
            max-width: 100%;
            /* Membuat gambar responsive, mengikuti lebar container */
            height: auto;
            /* Menjaga rasio gambar agar tetap proporsional */
            border-radius: 8px;
            /* Opsional, jika ingin memberikan border melengkung */
        }
    </style>
</head>
<body>
    <!-- Content of Events Page -->
    <div class="list-section " style="margin-top:100px; margin-bottom:100px;">
        <div>
            <h1 class="text-center">Detail Event</h1>
        </div>
    </div>
    <?php if ($event): ?>
        <div class="card mx-auto" style="max-width: 1200px; margin-bottom: 50px;">
            <!-- Menampilkan gambar acara -->
            <div class='img-container'><img src="../../assets/uploads/poster/<?= $event['poster'] ? $event['poster'] : 'default-image.jpg' ?>" class="card-img-top custom-img" alt='Foto Acara' class='event-img'></div>
            <!-- -->
            <div class="card-body">
                <!-- judul -->
                <h3 class="card-title">
                    <?= htmlspecialchars($event['title']); ?>
                </h3>

                <!-- status -->
                <p class="card-text"><strong>Status:</strong>
                    <?= htmlspecialchars($event['status_acara']) ?>
                </p>

                <!-- lokasi -->
                <p class="card-text"><strong>Lokasi:</strong>
                    <?= htmlspecialchars($event['venue_name']) ?>
                </p>

                <!-- tanggal -->
                <p class="card-text"><strong>Tanggal & Waktu:</strong>
                    <?= date('l, jS F Y H:i', strtotime($event['start_date'])) ?>
                    <?php if (!empty($event['end_date'])): ?>
                        - <?= date('l, jS F Y H:i', strtotime($event['end_date'])) ?>
                    <?php endif; ?>
                </p>

                <!-- untuk acara berbayar, nanti diisi HTM-->
                <?php if ($event['price'] > 0 ): ?>
                    <p class="card-text"><strong>HTM: </strong>
                        <?= htmlspecialchars($event['price']) ?>
                    </p>
                <?php endif; ?>

                <!-- deskripsi -->
                <p class="card-text">
                    <?= htmlspecialchars($event['description']); ?>
                </p>


                
                <a href="peserta.php?id=<?= $event['event_ID'] ?>" class="btn btn-primary">Lihat Peserta</a>
                <a href="update_event.php?id=<?= $event['event_ID'] ?>" class="btn btn-primary">Edit</a>
            </div>
        </div>
    <?php else: ?>
        <p>Acara tidak ditemukan.</p>
    <?php endif; ?>
    </div>
</body>

</html>

<?php require __DIR__ . '/../../includes/admin/footer.php'; // Penutup halaman ?>