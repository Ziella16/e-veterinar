<?php
session_start();
include('db_connect.php');

// Semak jika borang dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil username dan password daripada borang
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Semak jika input kosong
    if (empty($username) || empty($password)) {
        echo "Sila masukkan nama pengguna dan kata laluan.";
    } else {
        // Gunakan prepared statement untuk keselamatan
        $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Set sesi untuk admin jika berjaya
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin_dashboard.php'); // Redirect ke halaman dashboard
            exit();
        } else {
            echo "Nama pengguna atau kata laluan tidak sah.";
        }

        // Tutup prepared statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <style>
        body {
            background-image: url("assets/img/hero/background.jpg");
        }
    </style>
    <div class="login-card">
        <h2>Admin Login</h2>
        <h3>Log Masuk Admin</h3>

        <form class="login-form" method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
