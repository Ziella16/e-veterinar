<?php
session_start();
include('db_connect.php'); // Sambungkan ke database

// Semak jika borang telah dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sambung ke database dan semak jika pengguna wujud
    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Semak password
        if (password_verify($password, $row['password'])) {
            // Simpan maklumat pengguna dalam sesi
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $_SESSION['user_logged_in'] =true;
            // Alihkan pengguna ke halaman yang sesuai berdasarkan peranan
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
        } else {
            echo "Username atau password salah2!";
        }
    } else {
        echo "Username atau password salah!";
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
<main>
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
        <h2>Login to your account</h2>
        <h3>Log Masuk Pengguna</h3>

        <!-- Papar mesej error jika ada -->
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form class="login-form" method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="#">Forget your password?</a>
            <button type="submit">LOGIN</button>
        </form>
        <div class="options"></div>
            <p>Login as <a href="admin_login.php">Admin</a></p>
            <p>Create a new account  <a href="register.php">Sign Up</a></p>
        </div>
    </div>
    </main>
</body>
</html>
<?php
// Tutup sambungan ke database
$conn->close();
?>