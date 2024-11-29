<?php
class Acara {
    private $event_id;
    private $event_name;
    private $event_description;
    private $event_date;
    private $event_location;
    private $event_status;
    private $event_poster;

    public function __construct($event_name, $event_description, $event_date, $event_location= null, $event_status = "upcoming", $event_poster = null) {
        $this->event_name = $event_name;
        $this->event_description = $event_description;
        $this->event_date = $event_date;
        $this->event_location = $event_location;
        $this->event_status = $event_status;
        $this->event_poster = $event_poster;
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
    public function getDate() {
        return $this->event_date;
    }
    public function setDate($event_date) {
        $this->event_date = $event_date;
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
        $query = "INSERT INTO events (title, description, date, location, status, poster) VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->event_name,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->event_description,PDO::PARAM_STR);
        $stmt->bindParam(3, $this->event_date,PDO::PARAM_STR);
        $stmt->bindParam(4, $this->event_location,PDO::PARAM_STR);
        $stmt->bindParam(5, $this->event_status,PDO::PARAM_STR);
        $stmt->bindParam(6, $this->event_poster,PDO::PARAM_STR);
        $stmt->execute();
        $this->event_id = $pdo->lastInsertId();
    }

    public function uploadPoster($fileInputName='poster', $maxSize = 5 * 1024 * 1024, $allowedExtensions = ['jpg', 'jpeg', 'png']) {
        
        $posterFileName = null;
        $uploadDir = __DIR__ . '/../assets/img/poster/';
 
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
    
            $posterFileName = "poster_" . time() . "." . $fileExtension;
            $uploadPath = $uploadDir . $posterFileName;
    
            // Pindahkan file ke direktori tujuan
            if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
                die("Gagal mengupload file poster.");
            }
        }
    
        return $posterFileName;
    }

    public function setDetailEvent($event_name, $event_description, $event_date, $event_location, $event_poster, $event_status = "upcoming") {
        $this->setName($event_name);
        $this->setDescription($event_description);
        $this->setDate($event_date);
        $this->setLocation($event_location);
        $this->setStatus($event_status);
        $this->setPoster($event_poster);
    }
    
    public function editEvent($pdo){
        $query = "UPDATE events SET title = ?, description = ?, date = ?, location = ?, status = ?, poster = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->event_name,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->event_description,PDO::PARAM_STR);
        $stmt->bindParam(3, $this->event_date,PDO::PARAM_STR);
        $stmt->bindParam(4, $this->event_location,PDO::PARAM_STR);
        $stmt->bindParam(5, $this->event_status,PDO::PARAM_STR);
        $stmt->bindParam(6, $this->event_poster,PDO::PARAM_STR);
        $stmt->bindParam(7, $this->event_id,PDO::PARAM_STR);
        $stmt->execute();
    }
            

    public function deleteEvent($pdo, $delete_id){
        $query2 = "DELETE FROM acara_has_peserta WHERE id_acara = ?";
        $stmt = $pdo->prepare($query2);
        $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $query1 = "DELETE FROM events WHERE id = ?";
        $stmt = $pdo->prepare($query1);
        $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Event berhasil dihapus.";
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Gagal menghapus event. Error: " . $errorInfo[2];  // Tampilkan pesan kesalahan
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