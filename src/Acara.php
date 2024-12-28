<?php
include 'Admin.php';

class Acara extends Admin {
    private $event_id;
    private $event_name;
    private $event_type;
    private $event_location;
    private $event_start_date;
    private $event_end_date;
    private $event_description;
    private $event_poster;
    private $event_status;
    private $event_price;

    public function __construct(
            $event_name = "Default Event", 
            $event_type = "Default Type", 
            $event_location = "Default Location", 
            $event_start_date = "2024-01-01", 
            $event_end_date = "2024-01-02",  
            $event_description = "Default Description", 
            $event_status = 1, 
            $event_poster = null, 
            $event_price = 0) 
        {
        $this->event_name = $event_name;
        $this->event_type = $event_type;
        $this->event_location = $event_location;
        $this->event_start_date = $event_start_date;
        $this->event_end_date = $event_end_date;
        $this->event_description = $event_description;
        $this->event_poster = $event_poster;
        $this->event_status = $event_status;
        $this->event_price= $event_price;
    }
    
    public function tentukanStatusAcara() {
        $currentTime = new DateTime('now', new DateTimeZone('Asia/Jakarta')); // Waktu sekarang
        $startTime = new DateTime($this->event_start_date, new DateTimeZone('Asia/Jakarta'));
        $endTime = new DateTime($this->event_end_date, new DateTimeZone('Asia/Jakarta'));
    
        if ($currentTime < $startTime) {
            return 'UPCOMING';
        } elseif ($currentTime >= $startTime && $currentTime <= $endTime) {
            return 'ON GOING';
        } else {
            return 'COMPLETED';
        }
    }
    
    public function tambahAcara($pdo = null)
    {   
        $this->event_status = $this->tentukanStatusAcara(); // Tentukan status secara otomatis

        $query = "INSERT INTO events (title, event_type_ID,venue_ID, start_date, end_date, description, poster, status_acara, price) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->event_name,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->event_type,PDO::PARAM_STR);
        $stmt->bindParam(3, $this->event_location,PDO::PARAM_STR);
        $stmt->bindParam(4, $this->event_start_date,PDO::PARAM_STR);
        $stmt->bindParam(5, $this->event_end_date,PDO::PARAM_STR);
        $stmt->bindParam(6, $this->event_description,PDO::PARAM_STR);
        $stmt->bindParam(7, $this->event_poster,PDO::PARAM_STR);
        $stmt->bindParam(8, $this->event_status,PDO::PARAM_STR);
        $stmt->bindParam(9, $this->event_price,PDO::PARAM_STR);
        $stmt->execute();
        $this->event_id = $pdo->lastInsertId();
    }

    public function hapusAcara($pdo, $delete_id)
    {
        $query = "UPDATE events SET status_aktif = FALSE WHERE event_ID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            return "Event berhasil dihapus.";
            header("Location: events.php");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Gagal menghapus event. Error: " . $errorInfo[2];
        }
    }

    public function tampilkanAcara($pdo, $limit = null, $all = true)
    {
        $query = "SELECT * FROM vw_events_data WHERE status_aktif = 1 ";

        if(!$all) {
            $query .= "AND vw_events_data.start_date >= CURDATE() ";
        }

        $query .= " ORDER BY vw_events_data.start_date ASC ";

        if ($limit !== null) {
            $query .= " LIMIT :limit ";
        }
        
        $stmt = $pdo->prepare($query);

        if ($limit !== null) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showDetailAcara ($pdo, $event_id) {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE event_ID = :event_id");
        $stmt->execute(['event_id' => $event_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function uploadPoster($fileInputName='poster', $maxSize = 5 * 1024 * 1024, $allowedExtensions = ['jpg', 'jpeg', 'png']) {
        
        $posterFileName = null;
        $uploadDir = __DIR__ . '/../assets/uploads/poster/';
 
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = $_FILES[$fileInputName]['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
 
            if (!in_array($fileExtension, $allowedExtensions)) {
                throw new Exception("Ekstensi file tidak diizinkan. Harap upload file gambar (JPG, PNG, JPEG).");
            }

            if ($_FILES[$fileInputName]['size'] > $maxSize) {
                throw new Exception("File terlalu besar. Maksimum ukuran file adalah 5MB.");
            }

            $posterFileName = "poster_" . ($event_id ?? time()) . "." . $fileExtension;
            $uploadPath = $uploadDir . $posterFileName;
            if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
                throw new Exception("Gagal mengupload file poster.");
            }
    
            return $posterFileName;
        }
        throw new Exception("File poster tidak ditemukan atau terjadi kesalahan saat upload.");
    }

    public function searchEvent($pdo, $search) {
        $query = "SELECT * FROM events WHERE title LIKE ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['%' . $search . '%']);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    }

    public function hitungPeserta($pdo, $event_id) {
        $query = "SELECT COUNT(attendee_ID) FROM event_ticket_assignment WHERE event_ID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
        $attendee_row = $stmt->execute();

        
    }
}

?>