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
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="hidden" class="form-control" id="email" name="email">
                        <div class="row">

                            <div class="col-6 mb-3">

                                <label for="pet_name" class="form-label">Owner Name</label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name">
                            </div>
                            <div class="col-6 mb-3">

                                <label for="pet_name" class="form-label">Owner Phone</label>
                                <input type="text" class="form-control" id="owner_phone" name="owner_phone">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6 mb-3">

                                <label for="pet_name" class="form-label">Pet Name</label>
                                <input type="text" class="form-control" id="pet_name" name="pet_name">
                            </div>
                            <div class="col-6 mb-3">

                                <label for="pet_age" class="form-label">Age</label>
                                <input type="text" class="form-control" id="pet_age" name="pet_age">
                            </div>

                            <div class="col-6 mb-3">

                                <label for="pet_gender" class="form-label">Gender</label>
                                <input type="text" class="form-control" id="pet_gender" name="pet_gender">
                            </div>

                            <div class="col-6 mb-3">
                                <label for="pet_baka" class="form-label">Jenis Baka</label>
                                <input type="text" class="form-control" id="pet_baka" name="pet_baka">
                            </div>

                            <div class="mb-3">
                                <label for="pet_baka" class="form-label">Detail</label>
                                <input type="text" class="form-control" id="detail" name="detail">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6 mb-3">

                                <label for="vet" class="form-label">Vetenarian</label>
                                <select class="form-select" aria-label="Default select example" name="vet" required>
                                    <option selected>Open this select menu</option>
                                    <?php
                                    $query =
                                        "SELECT * FROM doctor";


                                    $results = mysqli_query($database, $query);


                                    while ($row = $results->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['docid'] ?>"><?php echo $row['docname'] ?></option>

                                    <?php }

                                    ?>

                                </select>
                            </div>
                            <div class="col-6 mb-3">

                                <label for="pet_age" class="form-label">Slot</label>
                                <select class="form-select" aria-label="Default select example" name="slot" required>
                                    <option selected>Open this select menu</option>
                                    <option value="1">9:00AM - 9:30AM</option>
                                    <option value="2">9:30AM - 10:00AM</option>
                                    <option value="3">10:00PM - 10:30AM</option>
                                    <option value="4">10:30AM - 11:00AM</option>
                                    <option value="5">11:00AM - 11:30AM</option>
                                    <option value="6">11:30AM - 12:00PM</option>
                                    <option value="7">12:00PM - 12:30PM</option>
                                    <option value="8">2:00PM - 2:30PM</option>
                                    <option value="9">2:30PM - 3:00PM</option>
                                    <option value="10">3:00PM - 3:30PM</option>
                                    <option value="11">3:30PM - 4:00PM</option>
                                    <option value="12">4:00PM - 4:30PM</option>

                                </select>
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
                        <button type="submit" class="btn btn-primary" name="set_appointment">Save changes</button>
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

    var DateClick = function (info) {

        console.log(info);

    };

    var EventClick = function (info) {
        $('#exampleModal').modal('show');
        // $('#date').val(info.dateStr);
        $('#id').val(info.event.id);
        $('#owner_name').val(info.event.extendedProps.owner_name);
        $('#owner_phone').val(info.event.extendedProps.owner_contact);
        
        $('#email').val(info.event.extendedProps.owner_email);

        $('#pet_name').val(info.event.extendedProps.pet_name);
        $('#pet_age').val(info.event.extendedProps.pet_age);
        $('#pet_baka').val(info.event.extendedProps.pet_breed);
        $('#pet_gender').val(info.event.extendedProps.pet_gender);
        $('#detail').val(info.event.extendedProps.detail);
        console.log(info.event);
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