<?php
session_start();
include('db_connect.php');

// Semak jika pengguna telah log masuk
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php'); // Jika tidak log masuk, redirect ke halaman log masuk
    exit();
}

// Dapatkan senarai janji temu yang sudah ditempah
$sql = "SELECT appointment_date FROM appointments WHERE status = 'Pending'";
$result = $conn->query($sql);
$appointments = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'title' => 'Booked',
            'start' => $row['appointment_date'],
            'color' => 'red'
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>
<body>
    <h1>Book an Appointment</h1>
    
    <form action="process_appointment.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required><br><br>

        <label for="appointment_date">Appointment Date:</label>
        <input type="hidden" name="appointment_date" id="appointment_date" required>
        
        <div id="calendar"></div><br><br>

        <input type="submit" value="Book Appointment">
    </form>

    <script>
        $(document).ready(function() {
            // Menyediakan FullCalendar
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: <?php echo json_encode($appointments); ?>,  // Menyediakan janji temu yang telah ditempah
                dayClick: function(date, jsEvent, view) {
                    // Set tarikh yang dipilih ke dalam input tersembunyi
                    $('#appointment_date').val(date.format());
                    alert("You have selected: " + date.format());
                }
            });
        });
    </script>
</body>
</html>
