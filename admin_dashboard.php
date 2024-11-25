<?php
session_start();
include('db_connect.php');

// Semak jika admin telah log masuk
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); // Jika tidak log masuk, redirect ke halaman log masuk
    exit();
}

// Dapatkan senarai pengguna
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p><a href="admin_logout.php">Log Keluar</a></p>
    
    <h2>Senarai Pengguna</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nombor Telefon</th>
            <th>Umur Haiwan</th>
            <th>Tarikh Pendaftaran</th>
            <th>Tindakan</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['pet_age'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | 
                          <a href='delete_user.php?id=" . $row['id'] . "'>Padam</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tiada pengguna dalam sistem.</td></tr>";
        }
        ?>
    </table>
    

</body>
</html>

<?php
// Tutup sambungan
$conn->close();
?>
