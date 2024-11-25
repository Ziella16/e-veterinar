<?php
session_start();
include('db_connect.php');

// Semak jika sesi untuk pengguna telah ditetapkan
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Jika tidak, arahkan mereka ke halaman login
    header("Location: login.php");
    exit();
}

// Dapatkan ID pengguna daripada sesi
$user_id = $_SESSION['user_id'];

// Ambil maklumat pengguna daripada pangkalan data
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // Pastikan ID adalah integer
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Semak jika pengguna wujud
if (!$user) {
    echo "Pengguna tidak dijumpai.";
    exit();
}

// Paparkan maklumat pengguna
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>
<body>
    <style>
        body {
            background-image: url("assets/img/hero/background.jpg");
        }
    </style>
    <div class="dashboard">
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>ID Pengguna: <?php echo $user['id']; ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        

        <a href="logout.php" class="logout-btn">Log Keluar</a>
    </div>
</body>
</html>
