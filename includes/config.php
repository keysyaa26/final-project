<?php

class Database{
    public static $instance = null;
    public $koneksi;

    public function __construct() {
        try {
<<<<<<< HEAD
            $this->koneksi = new PDO("mysql:host=localhost; dbname=bprotic_event_db", 'root', '');
=======
            $this->koneksi = new PDO("mysql:host=localhost;dbname=event_db", 'root', '');
>>>>>>> c19db86db2344600c8e63f19b3ba575329964d3a
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->koneksi;
    }
}

$db = new Database();
$pdo = $db->getConnection();

?>