<?php

class Peserta{
    private $id_peserta;
    private $nama;
    private $email;
    private $no_tlp;
    private $emailStatus;

    public function __construct( $nama, $email, $no_tlp) {
        // $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->no_tlp = $no_tlp;
    }

    // setter dan getter
    public function getIdPeserta() {
        return $this->id_peserta;
    }
    public function setId($id) {
        $this->id = $id_peserta;
    }

    public function getNama() {
        return $this->nama;
    }
    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNoHP() {
        return $this->no_tlp;
    }
    public function setNoHP($no_tlp) {
        $this->no_tlp = $no_tlp;
    }

    public function getEmailStatus() {
        return $this->emailStatus;
    }

    // method
    public function Daftar($pdo) {
        $query = "INSERT INTO attendee (name, email, phone) VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $this->nama,PDO::PARAM_STR);
        $stmt->bindParam(2, $this->email,PDO::PARAM_STR); 
        $stmt->bindParam(3, $this->no_tlp,PDO::PARAM_STR);
        $stmt->execute();
        return $this->id_peserta = $pdo->lastInsertId();
    }

    public function hapusPeserta($pdo, $delete_id) {
            $query= "DELETE FROM peserta WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return "Event berhasil dihapus.";
            } else {
                $errorInfo = $stmt->errorInfo();
                return "Gagal menghapus event. Error: " . $errorInfo[2];  // Tampilkan pesan kesalahan
            }
        }
    
    }


?>