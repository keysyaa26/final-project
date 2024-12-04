<?php
class Acara {
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

    public function __construct($event_name, $event_type, $event_location, $event_start_date, $event_end_date,  $event_description, $event_status, $event_poster = null, $event_price = 0) {
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

    // setter dan getter
    public function getIdAcara() {
        return $this->event_id;
    }
    public function setId($event_id) {
        $this->event_id = $event_id;
    }
    public function getName() {
        return $this->event_name;
    }
    public function setName($event_name) {
        $this->event_name = $event_name;
    }
    public function getDescription() {
        return $this->event_description;
    }
    public function setDescription($event_description) {
        $this->event_description = $event_description;
    }

    public function getStatus() {
        return $this->event_status;
    }
    public function setStatus($event_status) {
        $this->event_status = $event_status;
    }
    public function getPoster() {
        return $this->event_poster;
    }
    public function setPoster($event_poster) {
        $this->event_poster = $event_poster;
    }
    public function getLocation() {
        return $this->event_location;
    }
    public function setLocation($event_location) {
        $this->event_location = $event_location;
    }
    
    // method
    public function addEvent($pdo){
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

    public function uploadPoster($fileInputName='poster', $maxSize = 5 * 1024 * 1024, $allowedExtensions = ['jpg', 'jpeg', 'png']) {
        
        $posterFileName = null;
        $uploadDir = __DIR__ . '/../uploads/poster/';
 
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = $_FILES[$fileInputName]['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
 
            if (!in_array($fileExtension, $allowedExtensions)) {
                die("Ekstensi file tidak diizinkan. Harap upload file gambar (JPG, PNG, JPEG).");
            }

            if ($_FILES[$fileInputName]['size'] > $maxSize) {
                die("File terlalu besar. Maksimum ukuran file adalah 5MB.");
            }

            $posterFileName = "poster_" . ($event_id ?? time()) . "." . $fileExtension;
            $uploadPath = $uploadDir . $posterFileName;
            if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
                die("Gagal mengupload file poster.");
            }
    
            return $posterFileName;
        }
    }

    // public function setDetailEvent($event_name, $event_description, $event_date, $event_location, $event_poster, $event_status = "upcoming") {
    //     $this->setName($event_name);
    //     $this->setDescription($event_description);
    //     $this->setDate($event_date);
    //     $this->setLocation($event_location);
    //     $this->setStatus($event_status);
    //     $this->setPoster($event_poster);
    // }
    
    // public function editEvent($pdo){
    //     $query = "UPDATE events SET title = ?, description = ?, date = ?, location = ?, status = ?, poster = ? WHERE id = ?";
    //     $stmt = $pdo->prepare($query);
    //     $stmt->bindParam(1, $this->event_name,PDO::PARAM_STR);
    //     $stmt->bindParam(2, $this->event_description,PDO::PARAM_STR);
    //     $stmt->bindParam(3, $this->event_date,PDO::PARAM_STR);
    //     $stmt->bindParam(4, $this->event_location,PDO::PARAM_STR);
    //     $stmt->bindParam(5, $this->event_status,PDO::PARAM_STR);
    //     $stmt->bindParam(6, $this->event_poster,PDO::PARAM_STR);
    //     $stmt->bindParam(7, $this->event_id,PDO::PARAM_STR);
    //     $stmt->execute();
    // }
            

    public function deleteEvent($pdo, $delete_id){
        $query2 = "UPDATE events SET status_aktif = FALSE WHERE event_ID = ?";
        $stmt = $pdo->prepare($query2);
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

    public function searchEvent($pdo, $search) {
        $query = "SELECT * FROM events WHERE title LIKE ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['%' . $search . '%']);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    }
}

?>