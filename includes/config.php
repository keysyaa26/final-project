<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    public static $instance = null;
    public $koneksi;

    public function __construct() {
        try {
            // Muat file .env
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            // Ambil konfigurasi dari .env
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            // Buat koneksi PDO
            $this->koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->koneksi;
    }
}

// Inisialisasi koneksi
$db = new Database();
$pdo = $db->getConnection();

?>