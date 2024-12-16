<?php
include("../connection.php");
$start = ($_POST['calendarfetch']['start']);
  $end = ($_POST['calendarfetch']['end']);


  $start = date("Y-m-d", strtotime($start));
  $end = date("Y-m-d", strtotime($end));
$appointments = $database->query("SELECT * FROM `appointment_list` WHERE (schedule BETWEEN ('$start') AND ('$end') )");
$appoinment_arr = [];
$eventArray = array();

while ($row = $appointments->fetch_assoc()) {
    // if(!isset($appoinment_arr[$row['schedule']])) $appoinment_arr[$row['schedule']] = 0;
    // $appoinment_arr[$row['schedule']] += 1;
    $row['title'] =$row['owner_name'];
    $row['color'] = "#747af2";
    $row['textColor'] = "black";
    $row['start'] = $row['schedule'];
    $row['allDay'] = "true";
    array_push($eventArray, $row);
    // var_dump($row);
}
echo json_encode($eventArray);
die();
?>