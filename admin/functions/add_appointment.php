<?php
include("../../connection.php");
 require __DIR__ . '/../vendor/autoload.php';

// echo __DIR__ . '/../';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();
// Now you can use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendmail($receiver, $title, $filepath, $var = "")
{





    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'e-veterinar.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['email6_username'];
        $mail->Password = $_ENV['email6_password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465; // Adjust as needed (e.g., 465 for SSL)


        $mail->setFrom('appointment@e-veterinar.com', 'Attendance');
        $mail->addAddress($receiver);




        $mail->isHTML(true);

        $mail->Subject = $title;

        $mail->Body = $var['content'];         // Set the body with the content from the .php file
        $mail->AltBody = $title;
        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['add_appointment'])) {

    var_dump($_POST);
    $owner_name = $_POST['owner_name'];
    $contact = $_POST['contact'];
    $pet_id = $_POST['pet'];
    // $pet_name = $_POST['pet_name'];
    $date = $_POST['date'];
    // $pet_age = $_POST['pet_age'];
    // $pet_gender = $_POST['pet_gender'];
    // $pet_baka = $_POST['pet_baka'];
    // $vacc = $_POST['vacc'];
    // $circum = $_POST['circum'];

    if (isset($_POST['vacc'])) {
        $details = $_POST['vacc'];
    }


    if ($_POST['option'] == '1') {
        $details = 'Circumcision';

    }

    $query =
        "INSERT INTO appointment_list (pet_id,service_ids,date,owner_name,contact) 
        VALUES ('$pet_id','$details','$date' ,'$owner_name','$contact')";


    $results = mysqli_query($database, $query);

    header('location:' . $site_url . '/patient/book_appointment.php');


}
function convertTo24HourFormat($time)
{
    $date = DateTime::createFromFormat('g:iA', $time);
    return $date->format('H:i'); // Converts to 24-hour format
}


if (isset($_POST['set_appointment'])) {
    var_dump($_POST);

    $id = $_POST['id'];
    $doc_id = $_POST['vet'];
    $slot = $_POST['slot'];
    $email = $_POST['email'];

    $var = [
        'content' => 'Appointment Has Been Approved'
    ];

    $time_slots = [
        1 => ['start' => '9:00AM', 'end' => '9:30AM'],
        2 => ['start' => '9:30AM', 'end' => '10:00AM'],
        3 => ['start' => '10:00AM', 'end' => '10:30AM'],
        4 => ['start' => '10:30AM', 'end' => '11:00AM'],
        5 => ['start' => '11:00AM', 'end' => '11:30AM'],
        6 => ['start' => '11:30AM', 'end' => '12:00PM'],
        7 => ['start' => '12:00PM', 'end' => '12:30PM'],
        8 => ['start' => '2:00PM', 'end' => '2:30PM'],
        9 => ['start' => '2:30PM', 'end' => '3:00PM'],
        10 => ['start' => '3:00PM', 'end' => '3:30PM'],
        11 => ['start' => '3:30PM', 'end' => '4:00PM'],
        12 => ['start' => '4:00PM', 'end' => '4:30PM']
    ];

    $start = convertTo24HourFormat($time_slots[$slot]['start']);
    $end = convertTo24HourFormat($time_slots[$slot]['end']);


    $query =
        "UPDATE  appointment_list SET doc_id = '$doc_id' , time_start = '$start' , time_end='$end' WHERE id ='$id' ";


    $results = mysqli_query($database, $query);
    sendmail($email, "Appointment Time", "",  $var );

    header('location:' . $site_url . '/admin/book_appointment.php');


}


if (isset($_POST['set_appointment2'])) {
    var_dump($_POST);

    $id = $_POST['id'];
    $status = $_POST['status'];
    // $slot = $_POST['slot'];



    // $time_slots = [
    //     1 => ['start' => '9:00AM', 'end' => '9:30AM'],
    //     2 => ['start' => '9:30AM', 'end' => '10:00AM'],
    //     3 => ['start' => '10:00AM', 'end' => '10:30AM'],
    //     4 => ['start' => '10:30AM', 'end' => '11:00AM'],
    //     5 => ['start' => '11:00AM', 'end' => '11:30AM'],
    //     6 => ['start' => '11:30AM', 'end' => '12:00PM'],
    //     7 => ['start' => '12:00PM', 'end' => '12:30PM'],
    //     8 => ['start' => '2:00PM', 'end' => '2:30PM'],
    //     9 => ['start' => '2:30PM', 'end' => '3:00PM'],
    //     10 => ['start' => '3:00PM', 'end' => '3:30PM'],
    //     11 => ['start' => '3:30PM', 'end' => '4:00PM'],
    //     12 => ['start' => '4:00PM', 'end' => '4:30PM']
    // ];

    // $start=  convertTo24HourFormat($time_slots[$slot]['start']);
    // $end=  convertTo24HourFormat($time_slots[$slot]['end']);


    $query =
        "UPDATE  appointment_list SET status = '$status'   WHERE id ='$id' ";


    $results = mysqli_query($database, $query);
    header('location:' . $site_url . '/doctor/book_appointment.php');

}



if (isset($_POST['fetch_pet'])) {


    $user_id = $_POST['fetch_pet']['owner'];
    $query =
        "SELECT * FROM pet WHERE owner_id ='$user_id'";


    $results = mysqli_query($database, $query);


    if (mysqli_num_rows($results) > 0) {
        // Loop through the pets and create options
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "<option selected>No pets found</option>"; // In case no pets are found for this owner
    }
}

if (isset($_POST['add_appointment3'])) {

    var_dump($_POST);
    $owner_name = $_POST['owner'];
    // $contact = $_POST['contact'];
    $pet_id = $_POST['pet'];
    // $pet_name = $_POST['pet_name'];
    $date = $_POST['date'];
    // $pet_age = $_POST['pet_age'];
    // $pet_gender = $_POST['pet_gender'];
    // $pet_baka = $_POST['pet_baka'];
    // $vacc = $_POST['vacc'];
    // $circum = $_POST['circum'];

    if (isset($_POST['vacc'])) {
        $details = $_POST['vacc'];
    }


    if ($_POST['option'] == '1') {
        $details = 'Circumcision';

    }

    $query =
        "INSERT INTO appointment_list (pet_id,service_ids,date,owner_name,status) 
        VALUES ('$pet_id','$details','$date' ,'$owner_name','2')";


    $results = mysqli_query($database, $query);

    header('location:' . $site_url . '/doctor/book_appointment.php');


}