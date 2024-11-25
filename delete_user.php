<?php
session_start();
include('db_connect.php');

// Semak jika admin telah log masuk
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Dapatkan ID pengguna dari parameter URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Padamkan pengguna
    $delete_sql = "DELETE FROM `users` WHERE `id` = $user_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Pengguna telah dipadamkan.";
        header("Location: admin_dashboard.php");
    } else {
        echo "Ralat: " . $conn->error;
    }
}

$conn->close();
?>
