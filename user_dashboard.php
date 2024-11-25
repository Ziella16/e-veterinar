<?php
session_start();
include('db_connect.php');

// Semak jika sesi untuk pengguna telah ditetapkan
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Jika tidak, arahkan mereka ke halaman login
    header("Location: login.php");
    exit();
}

// Dapatkan ID pengguna daripada sesi
$user_id = $_SESSION['user_id'];

// Ambil maklumat pengguna daripada pangkalan data
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // Pastikan ID adalah integer
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Semak jika pengguna wujud
if (!$user) {
    echo "Pengguna tidak dijumpai.";
    exit();
}

if (isset($_POST['booking'])) {

    $title = $_POST['booking']['title'];
    $description = $_POST['booking']['description'];
    $time1 = $_POST['booking']['time1'];
    $time2 = $_POST['booking']['time2'];
    $date = $_POST['booking']['date'];

    echo $date;
    
    // $date1 = date("Y-m-d", strtotime($date));  
    // echo $date1;

    // $date1=date_create($date);
    // echo date_format($date1,"Y/m/d H:i:s");
    $time1a = date("Y-m-d H:i:s", strtotime($date . " $time1"));  
// echo $time1a;
    // $time1b = date_format($time1a, "Y-m-d H:i");
    $time2a = date("Y-m-d H:i:s", strtotime($date . " $time2"));  

    // $time2a = date_create("2013-03-15 " . $time2);
    // $time2b = date_format($time2a, "Y-m-d H:i");

    $query = "INSERT INTO  events (title,description,start_date,end_date) VALUES ('$title','$description','$time1a','$time2a')";
    $results = mysqli_query($conn, $query);


}

?>
<!-- // Paparkan maklumat pengguna -->
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-Veterinar </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">

                                <!-- Mobile Menu -->
                                <div class="col-12">
                                    <div class="mobile_menu d-block d-lg-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header End -->
    </header>
    <main>
        <!-- Hero Area Start -->
        <div class="slider-area2 slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center pt-50">
                            <h2>Book Appointment</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title></title>
            <link rel="stylesheet" href="" integrity="" crossorigin="">
        </head>

        <body>
            <div class="container">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3></h3>
                        </div>
                        <div class="col-sm-6">
                            <h3><a class="pull-right" href=""></a></h3>
                        </div>
                    </div>
                    <p class="lead"></p>
                </div>
                <div id="app"></div>
            </div>
            <script src="dist/vbc-browser.js"></script>
        </body>

        </html>



        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Appointment Calendar</title>
            <link rel="stylesheet" href="styles.css">
        </head>

        <body>
            <h1>Appointment Calendar</h1>
            <div class="calendar-container">
                <div class="calendar-header">
                    <button onclick="changeMonth(-1)">Prev</button>
                    <span id="currentMonth"></span>
                    <button onclick="changeMonth(1)">Next</button>
                </div>

                <div id="calendar" class="calendar"></div>

                <!-- Modal to add appointment -->
                <div id="appointmentModal" class="appointment-modal">
                    <h3>Book Appointment</h3>
                    <input type="text" id="appointmentTitle" placeholder="Title">
                    <input type="hidden" id="date">
                    <textarea id="appointmentDescription" placeholder="Description"></textarea>
                    <h4>Start</h4>
                    <input type="time" id="appointmentTime1">
                    <h4>End</h4>
                    <input type="time" id="appointmentTime2">
                    <button onclick="addAppointment()">Book Appointment</button>
                    <button onclick="closeModal()">Close</button>
                </div>
            </div>

            <script src="script.js"></script>
        </body>

        </html>

        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 0;
                padding: 20px;
                background-color: #ffffff;
                /* fallback for old browsers */

                ;
            }

            h1 {
                color: #333;
                margin-bottom: 20px;
            }

            .calendar-container {
                width: 80%;
                max-width: 900px;
                margin: 0 auto;
                background-color: #ffdde1;
                /* fallback for old browsers */


                ;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .calendar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            button {
                padding: 10px;
                background-color: #333;
                color: rgb(255, 255, 255);
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }


            button:hover {
                background-color: #ffffff;
            }

            #currentMonth {
                font-size: 24px;
                font-weight: bold;
                color: #333;
            }

            .calendar {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 10px;
                margin-top: 10px;
            }

            .day {
                padding: 20px;
                background-color: #333;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .day:hover {
                background-color: #f9b5b3;
            }

            .day.selected {
                background-color: #000000;
                color: white;
            }

            .appointment-modal {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #fff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                width: 300px;
                z-index: 1000;
            }

            .appointment-modal input,
            .appointment-modal textarea {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .appointment-modal button {
                width: 100%;
                padding: 10px;
                background-color: #232526;
                /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #414345, #232526);
                /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #414345, #232526);
                /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                ;
                color: rgb(255, 255, 255);
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .appointment-modal button:hover {
                background-color: #ffffff;
            }
        </style>














        </footer>
        <!-- Scroll Up -->
        <div id="back-top">
            <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
        </div>

        <!-- JS here -->

        <!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
        <script src="./assets/js/animated.headline.js"></script>

        <!-- Nice-select, sticky -->
        <script src="./assets/js/jquery.nice-select.min.js"></script>
        <script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        <script>
            let currentDate = new Date();
            let selectedDate = null;
            let appointments = {};

            // Change the month (forward or backward)
            function changeMonth(direction) {
                currentDate.setMonth(currentDate.getMonth() + direction);
                renderCalendar();
            }

            // Render the calendar for the current month
            function renderCalendar() {
                const calendar = document.getElementById('calendar');
                const currentMonthSpan = document.getElementById('currentMonth');
                const monthName = currentDate.toLocaleString('default', { month: 'long' });
                const year = currentDate.getFullYear();

                currentMonthSpan.innerText = `${monthName} ${year}`;

                const firstDayOfMonth = new Date(year, currentDate.getMonth(), 1).getDay();
                const totalDaysInMonth = new Date(year, currentDate.getMonth() + 1, 0).getDate();
                let dayHTML = '';

                // Empty spaces before the first day
                for (let i = 0; i < firstDayOfMonth; i++) {
                    dayHTML += `<div class="day"></div>`;
                }

                // Render the days of the month
                for (let day = 1; day <= totalDaysInMonth; day++) {
                    const dateString = `${year}-${currentDate.getMonth() + 1}-${day}`;
                    const hasAppointment = appointments[dateString] ? appointments[dateString].length > 0 : false;
                    dayHTML += `
            <div class="day ${hasAppointment ? 'has-appointment' : ''}" onclick="selectDate(${day})">
                <span>${day}</span>
            </div>
        `;
                }

                calendar.innerHTML = dayHTML;
            }

            // Select a date to add an appointment
            function selectDate(day) {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth() + 1;
                selectedDate = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;

                openModal();
            }

            // Open the appointment modal
            function openModal() {
                document.getElementById('appointmentModal').style.display = 'block';
            }

            // Close the appointment modal
            function closeModal() {
                document.getElementById('appointmentModal').style.display = 'none';
            }

            // Add an appointment to the selected date
            function addAppointment() {
                const title = document.getElementById('appointmentTitle').value;
                const description = document.getElementById('appointmentDescription').value;
                const time1 = document.getElementById('appointmentTime1').value;
                const time2 = document.getElementById('appointmentTime2').value;

                console.log(title);
                console.log(description);
                console.log(time1);
                console.log(time2);

                if (title && selectedDate) {
                    if (!appointments[selectedDate]) {
                        appointments[selectedDate] = [];
                    }

                    $.ajax({
                        type: "POST",
                        url: "user_dashboard.php",
                        data: {
                            booking: {
                                title: title,
                                description: description,
                                time1: time1,
                                time2: time2,
                                date: new Date(currentDate).toLocaleDateString('fr-CA', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                }),
                            },
                        },
                        success: function (response) {
                            // successCallback(JSON.parse(response));
                            console.log(response);
                        },
                    });
                    appointments[selectedDate].push({ title, description, time1, time2 });
                    closeModal();
                    renderCalendar();
                }
            }

            // Initialize the calendar on page load
            renderCalendar();
        </script>


        <div class="dashboard">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <p>ID Pengguna: <?php echo $user['id']; ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>
                <?php
                $query = "SELECT * FROM `events`";
                $results = mysqli_query($conn, $query);

                while ($row = $results->fetch_assoc()) {

                    echo $row['title'];
                    echo $row['start_date'];
                }
                ?>
            </p>
            <a href="logout.php" class="logout-btn">Log Keluar</a>
        </div>
</body>

</html>