<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Animal Patients</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com
    
    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }

    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


    //echo $userid;
    //echo $username;
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Appointments</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-doctor ">
            <a href="book_appointment.php" class="non-style-link-menu ">
                <div>
                    <p class="menu-text">View Appointment</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
            <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active">
                <div>
                    <p class="menu-text">My Animal Patients</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings   ">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <?php

    $selecttype = "All";
    $current = "All patients";
    if ($_POST) {

        if (isset($_POST["filter"])) {
            // var_dump($_POST);
            if ($_POST["showonly"] == 'all') {
                $sqlmain = "SELECT 
                                                    service_details.name AS service_name, 
                                                    pet.id AS pet_id, 
                                                    pet.name AS pet_name,
                                                                                            appointment_list.date,

                                                    COALESCE(appointment_list.status, 'Not Assigned') AS service_status
                                                FROM 
                                                    pet
                                                CROSS JOIN 
                                                    service_details
                                                LEFT JOIN 
                                                    appointment_list 
                                                    ON appointment_list.service_ids = service_details.name AND appointment_list.pet_id = pet.id
                                                ORDER BY 
                                                    pet_name, service_name;";
                $selecttype = "All";
                $current = "All patients";
            } else {
                $filter = $_POST["showonly"];
                $sqlmain = "SELECT 
                                        service_details.name AS service_name, 
                                        pet.id AS pet_id, 
                                        pet.name AS pet_name,
                                        appointment_list.date,
                                        COALESCE(appointment_list.status, 'Not Assigned') AS service_status
                                    FROM 
                                        pet
                                    CROSS JOIN 
                                        service_details
                                    LEFT JOIN 
                                        appointment_list 
                                        ON appointment_list.service_ids = service_details.name AND appointment_list.pet_id = pet.id WHERE pet.owner_id = '$filter'
                                    ORDER BY 
                                        pet_name, service_name;";
                $selecttype = "My";
                $current = "My patients Only";
            }
        }
    } else {
        $sqlmain = "SELECT 
    service_details.name AS service_name, 
    pet.id AS pet_id, 
    pet.name AS pet_name,
                                            appointment_list.date,

    COALESCE(appointment_list.status, 'Not Assigned') AS service_status
FROM 
    pet
 CROSS JOIN 
    service_details
LEFT JOIN 
    appointment_list 
    ON appointment_list.service_ids = service_details.name AND appointment_list.pet_id = pet.id
ORDER BY 
    pet_name, service_name;";
        $selecttype = "All";
    }



    ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">

                    <a href="patient.php"><button class="login-btn btn-primary-soft btn btn-icon-back"
                            style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>

                </td>




            </tr>



            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">

                            <form action="" method="post">

                                <td style="text-align: right;">
                                    Show Details About : &nbsp;
                                </td>
                                <td width="30%">
                                    <select name="showonly" id="" class="box filter-container-items"
                                        style="width:90% ;height: 37px;margin: 0;">
                                        <option value="" disabled selected hidden><?php echo $current ?></option>
                                        <br />
                                        <!-- <option value="my">My Animal Patients Only</option><br /> -->
                                        <option value="all">All Patients</option><br />

                                        <?php


                                        $query =
                                            "SELECT * FROM patient";


                                        $results = mysqli_query($database, $query);


                                        while ($row = $results->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['pid'] ?>"><?php echo $row['pname'] ?></option>
                                            <br />


                                        <?php }
                                        ?>


                                    </select>
                                </td>
                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter"
                                        class=" btn-primary-soft btn button-icon btn-filter"
                                        style="padding: 15px; margin :0;width:100%">
                            </form>
                </td>

            </tr>
        </table>

        </center>
        </td>

        </tr>

        <tr>
            <td colspan="4">
                <center>
                    <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                            <thead>
                                <tr>
                                    <th class="table-headin">


                                        Pet Name

                                    </th>
                                    <th class="table-headin">


                                        Details

                                    </th>
                                    <th class="table-headin">


                                        Date

                                    </th>

                                    <th class="table-headin">

                                        Events
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                $result = $database->query($sqlmain);
                                //echo $sqlmain;
                                if ($result->num_rows == 0) {
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                                } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        // var_dump($row);
                                        $id = $row["pet_id"];

                                        $name = $row["pet_name"];
                                        $details = $row["service_name"];
                                        $date = $row["date"];
                                        if ($row["service_status"] == '2') {
                                            $status = 'Outside Clinic';
                                        }
                                        if ($row["service_status"] == '1') {
                                            $status = 'Done';
                                        }
                                        if ($row["service_status"] == 'Not Assigned') {
                                            $status = 'Not Yet';
                                        }

                                        echo '<tr>
                                        <td> &nbsp;' .
                                            $name
                                            . '</td>
                                        <td>
                                        ' . $details . '
                                        </td>
                                         <td>
                                        ' . $date . '
                                        </td>
                                         
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                         <button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">' . $status . '</font></button> 
                                       
                                        </div>
                                        </td>
                                    </tr>';

                                    }
                                }

                                ?>

                            </tbody>

                        </table>
                    </div>
                </center>
            </td>
        </tr>



        </table>
    </div>
    </div>
    <?php
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        $sqlmain = "select * from patient where pid='$id'";
        $result = $database->query($sqlmain);
        $row = $result->fetch_assoc();
        $name = $row["pname"];
        $email = $row["pemail"];
        $nic = $row["pnic"];
        $dob = $row["pdob"];
        $tele = $row["ptel"];
        $address = $row["paddress"];
        echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    P-' . $id . '<br><br>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $nic . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $address . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Date of Birth: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $dob . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';

    }
    ;

    ?>
    </div>

</body>

</html>