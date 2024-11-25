<?php
session_start();
include('db_connect.php');

// Semak jika pengguna telah log masuk
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Dapatkan maklumat dari borang
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$appointment_date = $_POST['appointment_date'];

// Semak jika tarikh sudah ditempah
$sql = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date' AND status = 'Pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Tarikh yang dipilih sudah ditempah. Sila pilih tarikh lain.";
    exit();
}

// Dapatkan ID pengguna (angggap pengguna sudah wujud dalam tabel `users`)
$sql = "SELECT id FROM users WHERE email = '$email'";
$result = $conn->query($sql);
$user_id = null;

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['id'];
} else {
    // Jika pengguna tidak ada, masukkan mereka dalam tabel users
    $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
    } else {
        echo "Error: " . $conn->error;
        exit();
    }
}

// Masukkan janji temu ke dalam tabel appointments
$sql = "INSERT INTO appointments (user_id, appointment_date, status) 
        VALUES ('$user_id', '$appointment_date', 'Pending')";

if ($conn->query($sql) === TRUE) {
    echo "Appointment successfully booked!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
