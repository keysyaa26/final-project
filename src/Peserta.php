<?php

class Peserta
{
    private $id_peserta;
    private $nama;
    private $email;
    private $no_tlp;
    private $emailStatus;

    public function __construct($nama, $email, $no_tlp)
    {
        // $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->no_tlp = $no_tlp;
    }

    // setter dan getter
    public function getIdPeserta()
    {
        return $this->id_peserta;
    }

    public function getNama()
    {
        return $this->nama;
    }
    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNoHP()
    {
        return $this->no_tlp;
    }
    public function setNoHP($no_tlp)
    {
        $this->no_tlp = $no_tlp;
    }

    public function getEmailStatus()
    {
        return $this->emailStatus;
    }

    // method
    public function Daftar($pdo)
    {
        $query = "INSERT INTO attendee (name, email, phone) VALUES (?,?,?)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(1, $this->nama, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->email, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->no_tlp, PDO::PARAM_STR);
        $stmt->execute();
        return $this->id_peserta = $pdo->lastInsertId();
    }

    public function hapusPeserta($pdo, $delete_id)
    {
        $query = "UPDATE event_ticket_assignment SET status = FALSE WHERE attendee_ID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Event berhasil dihapus.";
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Gagal menghapus event. Error: " . $errorInfo[2];  // Tampilkan pesan kesalahan
        }
    }

    public function saveRegistrationData($pdo, $id_peserta, $id_acara, $qr_code, $price = 0)
    {
        $query = "INSERT INTO event_ticket_assignment (attendee_ID, event_ID, price, QR_code) VALUES (:attendee_id, :event_id, :price, :qr_code)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':attendee_id', $id_peserta,  PDO::PARAM_INT);
        $stmt->bindParam(':event_id', $id_acara,  PDO::PARAM_INT);
        $stmt->bindParam(':price', $price,  PDO::PARAM_INT);
        $stmt->bindParam(':qr_code', $qr_code,  PDO::PARAM_STR);
        $stmt->execute();
    }

    public function hitungPeserta($pdo, $events = null, $status = null)
    {
        $event_id = (int) $events;

        if ($status !== null) {
            $query = "SELECT COUNT(attendee_ID) FROM event_ticket_assignment WHERE event_ID = ? AND attendance_status = ?";
        } else {
            $query = "SELECT COUNT(attendee_ID) FROM event_ticket_assignment WHERE event_ID = ?";
        }

        $stmt = $pdo->prepare($query);

        if ($status !== null) {
            $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $status, PDO::PARAM_STR);  // Pastikan status sebagai string
        } else {
            $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $attendee_row = $stmt->fetchColumn();

        return $attendee_row;
    }

    public function exportData()
    {
        // ... Implementasi export data peserta
    }
}
