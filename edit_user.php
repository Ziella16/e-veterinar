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

    // Dapatkan maklumat pengguna
    $sql = "SELECT * FROM `users` WHERE `id` = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Pengguna tidak ditemui!";
        exit();
    }
}

// Semak jika borang dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pet_age = $_POST['pet_age'];

    // Kemaskini maklumat pengguna
    $update_sql = "UPDATE `users` SET 
                    `username` = '$username',
                    `email` = '$email',
                    `contact` = '$contact',
                    `pet_age` = '$pet_age'
                    WHERE `id` = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Maklumat pengguna telah dikemaskini!";
        header("Location: admin_dashboard.php");
    } else {
        echo "Ralat: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
</head>
<body>
    <h2>Edit Maklumat Pengguna</h2>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>

        <label for="email">Emel:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

        <label for="contact">Nombor Telefon:</label>
        <input type="text" name="contact" value="<?php echo $user['contact']; ?>" required><br><br>

        <label for="pet_age">Umur Haiwan:</label>
        <input type="number" name="pet_age" value="<?php echo $user['pet_age']; ?>" required><br><br>

        <button type="submit">Kemaskini</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
