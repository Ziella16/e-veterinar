<?php
// Database connection
$servername = "localhost"; // or your database server
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "my_database"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $owner_name = $_POST['OwnerName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pet_category = $_POST['PetCategory'];
    $pet_issue = $_POST['PetIssue'];
    $appointment_date = $_POST['date'];

    // Insert data into the appointments table
    $sql = "INSERT INTO appointments (owner_name, email, phone, pet_category, pet_issue, appointment_date)
            VALUES ('$owner_name', '$email', '$phone', '$pet_category', '$pet_issue', '$appointment_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt = $conn->prepare("INSERT INTO appointments (owner_name, email, phone, pet_category, pet_issue, appointment_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $owner_name, $email, $phone, $pet_category, $pet_issue, $appointment_date);
$stmt->execute();

    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/doctorAppointment.css" />
    <link rel="stylesheet" href="../styles/alert.css" />
    <link rel="stylesheet" href="../styles/navbar.css" />
    <script src="https://kit.fontawesome.com/add05b7e25.js" crossorigin="anonymous"></script>
    <script src="../scripts/navbar.js" defer></script>
    <title>Doctor Appointment</title>
  </head>
  <body>
    <header>
      <div class="nvbr">
        <img src="../assets/images/Pet-Vet logo.png" alt="" />
        <a href="../index.html">Home</a>
        <a href="../html/doctorsdetails.html">Appointment</a>
        <a href="../html/doctorApply.html">Doctor Apply</a>
        <div id="loginOpt">Login</div>
        <div id="logindrop">
          <a id="loginData" href="../html/adminLogin.html">Admin Login</a>
          <a id="loginData" href="../html/login.html">Doctor Login</a>
        </div>
        <div id="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </header>

    <h1 id="heading">Appoint Your Doctor</h1>
    <form id="Doctor_Appointment_form" action="submit_appointment.php" method="POST">
      <label for="OwnerName">Owner Name</label>
      <input type="text" id="OwnerName" name="OwnerName" placeholder="Your Name" required />
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Your Email" required />
      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" placeholder="Your Phone Number" required />
      <label for="PetCategory">Pet Category</label>
      <select name="PetCategory" id="PetCategory">
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
        <option value="Corokodile">Corokodile</option>
        <option value="Fish">Fish</option>
        <option value="Hamster">Hamster</option>
        <option value="Bird">Bird</option>
        <option value="Rabbit">Rabbit</option>
        <option value="Lizard">Lizard</option>
      </select>
      <label for="PetIssue">Pet Issue</label>
      <select name="PetIssue" id="PetIssue">
        <option value="general">General Medical Question</option>
        <option value="diarrhea">Diarrhea or bowel issues</option>
        <option value="ear">Ear infection</option>
        <option value="appetite">Loss of appetite</option>
        <option value="throwing-up">Throwing up</option>
        <option value="behavioural">Behavioural problems</option>
        <option value="skin">Skin rash or allergy</option>
        <option value="injury">Injury</option>
        <option value="dental">Dental issues</option>
        <option value="other">Other</option>
      </select>
      <label for="date">Appointment Date</label>
      <input type="date" id="date" name="date" required />
      <input type="submit" id="submit_button" value="Submit" />
    </form>
  </body>
</html>
<?php
// Tutup sambungan ke database
$conn->close();
?>