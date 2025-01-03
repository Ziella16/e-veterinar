<?php
include("../../connection.php");


if (isset($_POST['fetch_appointment'])) {

    // var_dump($_POST);
    // $pet_name = $_POST['pet_name'];


    $query =
        "SELECT a.*, b.name as pet_name,b.gender as gender, b.breed as breed,  b.age as age, c.pname as owner_name2  , c.ptel as owner_contact , c.pemail  FROM appointment_list a 
        INNER JOIN pet b ON b.id = a.pet_id 
        INNER JOIN patient c ON c.pid = a.owner_name;
        ";


    $results = mysqli_query($database, $query);


    while ($row = $results->fetch_assoc()) {
        if ($row['status'] == '0' && $row['doc_id'] == "") {
            $color = '#FF9800';
        }
        if ($row['status'] == '0' && $row['doc_id'] != "") {
            $color = '#03A9F4';
        }
        if ($row['status'] == '1'  ) {
            $color = '#66BB6A';
        }
        if ($row['status'] == '2'  ) {
            $color = '#78909C';
        }
        $events[] = array(
            'id' => $row['id'],                       // Unique identifier for the event
            'title' => $row['pet_name'],                // Status or description of the event
            'start' => $row['date'],       // Date of the attendance
            // 'masa' => date("Y-m-d H:i:s", strtotime("now")),
            'allDay' => 'true',
            'owner_contact' => $row['owner_contact'],
            'owner_name' => $row['owner_name2'],
            'owner_email' => $row['pemail'],
            'pet_name' => $row['pet_name'],
            'pet_age' => $row['age'],
            'pet_gender' => $row['gender'],
            'pet_breed' => $row['breed'],
            'detail' => $row['service_ids'],
            'doc_id' => $row['doc_id'],
            'status' => $row['status'],
            'color' => $color,

            // Optionally add 'end' or other event properties here
        );
    }

    echo json_encode($events);
    // die();


}



if (isset($_POST['fetch_appointment_patient'])) {

    // var_dump($_POST);
    $pid = $_POST['fetch_appointment_patient']['user_id'];


    $query =
        "SELECT a.*, b.name as pet_name,b.gender as gender, b.breed as breed,  b.age as age, c.pname as owner_name2  , c.ptel as owner_contact , c.pemail  FROM appointment_list a 
        INNER JOIN pet b ON b.id = a.pet_id 
        INNER JOIN patient c ON c.pid = a.owner_name
        WHERE a.owner_name= '$pid'
        ";


    $results = mysqli_query($database, $query);


    while ($row = $results->fetch_assoc()) {
        if ($row['status'] == '0' && $row['doc_id'] == "") {
            $color = '#FF9800';
        }
        if ($row['status'] == '0' && $row['doc_id'] != "") {
            $color = '#03A9F4';
        }
        if ($row['status'] == '1'  ) {
            $color = '#66BB6A';
        }
        $events[] = array(
            'id' => $row['id'],                       // Unique identifier for the event
            'title' => $row['pet_name'],                // Status or description of the event
            'start' => $row['date'],       // Date of the attendance
            // 'masa' => date("Y-m-d H:i:s", strtotime("now")),
            'allDay' => 'true',
            'owner_contact' => $row['owner_contact'],
            'owner_name' => $row['owner_name2'],
            'owner_email' => $row['pemail'],
            'pet_name' => $row['pet_name'],
            'pet_age' => $row['age'],
            'pet_gender' => $row['gender'],
            'pet_breed' => $row['breed'],
            'detail' => $row['service_ids'],
            'doc_id' => $row['doc_id'],
            'status' => $row['status'],
            'color' => $color,
            // Optionally add 'end' or other event properties here
        );
    }

    echo json_encode($events);
    // die();


}