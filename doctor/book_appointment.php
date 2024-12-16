<style>
    .fc-event-title-container {
        text-align: center;
    }

    .fc-event-title.fc-sticky {
        font-size: 2em;
    }
</style>
<?php

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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../assets/vendors/fullcalendar/js/test2.js"></script>
<script src="../assets/vendors/fullcalendar/js/index.global.min.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        function getAllEvents(info, successCallback, failureCallback) {
             console.log((info.startStr));
             console.log((info.endStr));

            $.ajax({
                type: "POST",
                url: "calendar_fetch.php",
                data: {
                    calendarfetch: {
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
        });
        calendar.render();
    });

</script>
