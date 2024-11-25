<?php
session_start();

// Padamkan semua sesi
$_SESSION = array();  // Padamkan semua data sesi

// Jika menggunakan cookie sesi, padamkan cookie juga
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Hancurkan sesi
session_destroy();

// Arahkan pengguna ke halaman log masuk
header("Location: login.php");
exit();
