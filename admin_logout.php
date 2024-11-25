<?php
session_start();
session_unset(); // Hapuskan sesi
session_destroy(); // Musnahkan sesi
header('Location: admin_login.php'); // Redirect ke halaman login
exit();
?>
