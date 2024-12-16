<style>
    .fc-event-title-container {
        text-align: center;
    }

    .fc-event-title.fc-sticky {
        font-size: 2em;
    }
</style>
<?php
session_start();
include("../connection.php");

?>
<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header rounded-0">
                    <h4 class="card-title">Appointment Availablity</h4>
                </div>
                <div class="card-body">
                    <div id="appointmentCalendar"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Set Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="../admin/functions/add_appointment.php">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="date" name="date">

                        <?php


                        ?>
                        <input type="hidden" class="form-control" name="owner_name"
                            value="<?php echo $_SESSION['user_name'] ?>">
                        <input type="hidden" class="form-control" name="contact"
                            value="<?php echo $_SESSION['user_phone'] ?>">

                        <div class="mb-3">
                            <label for="pet_baka" class="form-label">Pet</label>
                            <select class="form-select" aria-label="Default select example" name="pet" required>
                                <option selected>Open this select menu</option>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $query =
                                    "SELECT * FROM pet WHERE owner_id ='$user_id'";


                                $results = mysqli_query($database, $query);


                                while ($row = $results->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                                <?php }

                                ?>

                            </select>
                        </div>

                        <div id="option">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="option" value="1">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Circum
                                </label>

                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="option" value="0">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Vacc
                                </label>
                            </div>


                        </div>
                        <div id="vac2" class="d-none">

                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="vacc" id="inlineRadio1"
                                    value="Dos 1">
                                <label class="form-check-label" for="inlineRadio1">Dos 1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vacc" id="inlineRadio2"
                                    value="Dos 2">
                                <label class="form-check-label" for="inlineRadio2">Dos 2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vacc" id="inlineRadio3"
                                    value="Dos 3">
                                <label class="form-check-label" for="inlineRadio3">Booster</label>
                            </div>
                        </div>


                        <!-- <div id="circum2" class="d-none">

                            <div class="form-check form-check-inline  ">
                                <input class="form-check-input" type="radio" name="circum" id="inlineRadio1" value="Circumcision Male">
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="circum" id="inlineRadio2" value="Circumcision Female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div> -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_appointment">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="../assets/vendors/fullcalendar/js/test2.js"></script>
<script src="../assets/vendors/fullcalendar/js/index.global.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        function getAllEvents(info, successCallback, failureCallback) {
            console.log((info.startStr));
            console.log((info.endStr));

            $.ajax({
                type: "POST",
                url: "../admin/functions/fetch_appointment.php",
                data: {
                    fetch_appointment: {
                        start: info.startStr,
                        end: info.endStr,
                    },
                },
                success: function (response) {
                    console.log(JSON.parse(response));

                    successCallback(JSON.parse(response));
                },
            });
        }
        var calendarEl = document.getElementById('appointmentCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: getAllEvents,
            eventClick: EventClick,
            dateClick: DateClick,
        });
        calendar.render();
    });

    var EventClick = function (info) {

        console.log(info);

    };

    var DateClick = function (info) {
        $('#exampleModal').modal('show');
        $('#date').val(info.dateStr);

        console.log(info);
    };
    $("#option").on("click", function () {
        var test = $("input[name='option']:checked").val();

        if (test == '1') {
            // if ($("#circum2").hasClass("d-none")) {

            //     $('#circum2').removeClass("d-none");
            // }
            if (!$("#vac2").hasClass("d-none")) {

                $('#vac2').addClass("d-none");
            }
        }
        else {
            // if (!$("#circum2").hasClass("d-none")) {

            //     $('#circum2').addClass("d-none");
            // }
            if ($("#vac2").hasClass("d-none")) {

                $('#vac2').removeClass("d-none");
            }
        }
        console.log(test);

    });
</script>