<?php
include("../../connection.php");


if (isset($_POST['add_pet'])) {

    var_dump($_POST);
    $user_id = $_POST['user_id'];
    // $contact = $_POST['contact'];
    $category = $_POST['category'];

    $pet_name = $_POST['pet_name'];
    // $date = $_POST['date'];
    $pet_age = $_POST['pet_age'];
    $pet_gender = $_POST['pet_gender'];
    $pet_baka = $_POST['pet_baka'];
    // $vacc = $_POST['vacc'];
    // $circum = $_POST['circum'];



    $query =
        "INSERT INTO pet (owner_id,name,age,gender,breed,category_id) 
        VALUES ('$user_id','$pet_name','$pet_age','$pet_gender','$pet_baka' ,'$category')";


    $results = mysqli_query($database, $query);

    header('location:' . $site_url . '/patient/book_appointment.php');


}