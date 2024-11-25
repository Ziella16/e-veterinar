<?php
// Memasukkan sambungan ke database
include('db_connect.php');

// Semak jika form pendaftaran dihantar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai yang dihantar dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pet_age = $_POST['pet_age'];
    $password = $_POST['psw'];
    $password2 = $_POST['psw-repeat'];
    if ($password != $password2) {
      $error = "Ralat semasa pendaftaran: " ;
    }
    // Hash kata laluan untuk keselamatan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data pengguna baru ke dalam jadual users
    $sql = "INSERT INTO users (username, email, contact, pet_age, password) 
            VALUES ('$username', '$email', '$contact', '$pet_age', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Pendaftaran berjaya! Sila log masuk.";
    } else {
        $error = "Ralat semasa pendaftaran: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
  <main>
    

      <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
          <h1>Register</h1>
          <p>Create a Pet Parent account.</p>
          <hr>

  <!-- Papar mesej error atau kejayaan -->
  <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            <?php if (isset($message)) { echo "<p style='color:green;'>$message</p>"; } ?>

            <!-- Borang pendaftaran -->
            <form action="register.php" method="POST">

          
          <label for="username"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="username" id="username" required>
      
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" id="email" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      
          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
      
          <label for="contact"><b>Contact</b></label>
          <input type="text" placeholder="Enter contact" name="contact" id="contact" required>
      
          <label for="pet name"><b>Your Pet Name</b></label>
          <input type="text" placeholder="Enter your pet name" name="pet name" id="pet name" required>
      

        </label>
        <label>Your Pet Type
          <select name="referrer">
            <option value="">(select)</option>
            <option value="1">Cat</option>
            <option value="2">Dog</option>
            <option value="3">Other</option>
          </select>
        </label>
      
          <label for="age"><b>Your Pet Age</b></label>
          <label>Input your pet age (years): <input type="number" name="age" min="0" max="120" />
      
            <label>Upload a Your Pet Picture: <input type="file" name="file" /></label>
        
        
            <label>Reason:
              <textarea name="bio" rows="3" cols="30" placeholder="Details about Your Pet"></textarea>
            </label>

          <hr>
         
          <fieldset>
       
            <label>
              <input type="checkbox" name="terms" class="inline" required /> I accept the <a href="">terms and conditions</a>
            </label>
          </fieldset>
      
        </fieldset>
        <input name="register" type="submit" value="Submit" />
      
        </div>
        
        <div class="container signin">
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
      </form>

      
      
       
      </main>
  </body>
</html>

<?php
// Tutup sambungan ke database
$conn->close();
?>