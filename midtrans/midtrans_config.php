<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Midtrans\Config;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
Config::$clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];
Config::$isProduction = false; // Ubah ke true jika sudah live
Config::$isSanitized = true;
Config::$is3ds = true;

?>
