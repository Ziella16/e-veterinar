<?php
$host = 'localhost';  // Server database
$username = 'root';   // Username untuk login ke MySQL (biasanya root dalam XAMPP)
$password = '';       // Kata laluan untuk MySQL (biasanya kosong dalam XAMPP)
$database = 'my_database';  // Nama pangkalan data yang anda gunakan

// Sambungkan ke MySQL menggunakan mysqli
$conn = new mysqli($host, $username, $password, $database);

// Semak sambungan
if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}
?>
