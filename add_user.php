<?php
include('db_connect.php');

// Hash password untuk admin dan pengguna
$admin_password = password_hash("adminpassword", PASSWORD_DEFAULT);
$user_password = password_hash("userpassword", PASSWORD_DEFAULT);

// Masukkan admin
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $admin_username = 'admin', $admin_password);
$stmt->execute();

// Masukkan pengguna
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_username = 'user', $user_password);
$stmt->execute();

echo "Pengguna dan admin telah ditambah dengan berjaya!";
?>
