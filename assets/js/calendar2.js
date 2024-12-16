/* global FullCalendar */

/**
 * --------------------------------------------------------------------------
 * CoreUI PRO Boostrap Admin Template calendar.js
 * License (https://coreui.io/pro/license)
 * --------------------------------------------------------------------------
 */

document.addEventListener("DOMContentLoaded", () => {
  function isMobile() {
    return window.innerWidth <= 768; // Change this value based on your mobile breakpoint
  }

  function getAllEvents(info, successCallback, failureCallback) {
    // console.log((info.startStr));
    // console.log((info.endStr));

    $.ajax({
      type: "POST",
      url: "calendarfetch2",
      data: {
        calendarfetch2: {
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

  function clickonEvent(info) {
    console.log(info.event);

    if (info.event.extendedProps.event_status == 1) {
      document.getElementById("user_info").src =
        document.getElementById("user_info").getAttribute("data-urlsite") +
        info.event.extendedProps.user_id +
        "/" +
        info.event.extendedProps.image_url;

      document.getElementById("kaunselor_updateevent_title").innerHTML =
        info.event.title;
      document.getElementById("kaunselor_updateevent_id").value = info.event.id;
      document.getElementById("kaunselor_updateevent_date").value = new Date(
        info.event.startStr
      ).toLocaleDateString("en-MY");

      document.getElementById("kaunselor_updateevent_nama").value =
        info.event.extendedProps.nama;
      document.getElementById("kaunselor_updateevent_ndp").value =
        info.event.extendedProps.ndp;

      if (info.event.extendedProps.jenis == 1) {
        document.getElementById("kaunselor_updateevent_type").value = "Online";
      } else {
        document.getElementById("kaunselor_updateevent_type").value = "Offline";
      }

      showmodal("kaunselor_updateevent");
    } else {
      // document.getElementById("kaunselor_updateevent_type").value = "Offline";
    }

    // if (info.event.backgroundColor != "gray") {
    //   if (info.event.extendedProps.event_status != 0) {
    //     showmodal(
    //       "user_calendarevent",
    //       info.event.extendedProps.masalah,
    //       info.event.id,
    //       info.event.startStr
    //     );
    //   } else {
    //     showtoast("rejected");
    //   }
    // }
  }

  // function selectDate(info) {
  //   // var title = prompt("Event Title:");

  //   const user_id = document.getElementById("user_calendaradd_id").value;
  //   showmodal("user_calendaradd", null, user_id, info.startStr, info.title);

  //   calendar.unselect();
  // }

  const calendarEl = document.getElementById("calendar");

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listDay",
    },
    // allDay: true,
    events: getAllEvents,
    lazyFetching: true,
    // selectable: true,
    // selectHelper: true,
    // selectConstraint: {
    //   start: "00:01",
    //   end: "23:59",
    // },
    height: "auto",

    // eventLongPressDelay: 500, // Helps with touch responsiveness
    // LongPressDelay: 500, // Helps with touch responsiveness
    // selectLongPressDelay: 500,

    eventOrder: function (a, b) {
      const order = [1, 2, 0];
      const statusA = parseInt(a.extendedProps.event_status);
      const statusB = parseInt(b.extendedProps.event_status);

      return order.indexOf(statusA) - order.indexOf(statusB);
    },
    eventContent: function (info) {
      let eventTitle;
      let maxTitleLength = 20; 
      // If on mobile, use extendedProps, otherwise use the default title
      if (isMobile()) {
        eventTitle = info.event.extendedProps.ndp; // Replace 'customTitle' with the actual extendedProp you want to display
      } else {
        
       eventTitle = info.event.title.length > maxTitleLength ? info.event.title.substring(0, maxTitleLength) + '...' : info.event.title;
      }

      // Return the event content as a DOM element
      let titleElement = document.createElement("div");
      titleElement.innerHTML = eventTitle;
      return { domNodes: [titleElement] };
    },
    windowResize: function (arg) {
      calendar.render();
    },
    // select: selectDate,
    eventClick: clickonEvent,
    hiddenDays: [0, 6],
  });
  calendar.render();

  $("#kaunselor_updateevent_button1").click(function () {
    // calendar_add("user_calendaradd");
    console.log("reject");

    var event_id = document.getElementById("kaunselor_updateevent_id").value;
    var sebab = document.getElementById(
      "kaunselor_updateevent_sebabreject"
    ).value;

    if (sebab != "") {
      hidemodal();

      //  coreui.Modal("#kaunselor_updateevent");
      $.ajax({
        type: "POST",
        url: "kaunselor_reject",
        data: {
          kaunselor_reject: {
            id: event_id,
            sebab: sebab,
          },
        },
        success: function (response) {
          console.log(response);
          calendar.refetchEvents();
        },
      });
    } else {
      showtoast("Sila Masukkan Sebab");
    }

    // calendar.render();
  });

  $("#kaunselor_updateevent_button2").click(function () {
    console.log("approve");

    var event_id = document.getElementById("kaunselor_updateevent_id").value;
    var mula = document.getElementById("timeInput1").value;
    var tamat = document.getElementById("timeInput2").value;
    // console.log(mula);

    if (mula != "" && tamat != "") {
      hidemodal();

      $.ajax({
        type: "POST",
        url: "kaunselor_approve",
        data: {
          kaunselor_approve: {
            id: event_id,
            mula: mula,
            tamat: tamat,
          },
        },
        success: function (response) {
          console.log(response);
          calendar.refetchEvents();
        },
      });
    } else {
      showtoast("Sila Masukkan Masa Mula Dan Tamat");
    }
    // calendar.render();

    // calendar_delete("user_calendarevent");
  });

  $('input[name="options-outlined"]').click(function () {
    // alert('You selected: ' + $(this).val());
    if ($(this).val() == 1) {
      if (!$("#kaunselor_updateevent_reject").hasClass("d-none")) {
        $("#kaunselor_updateevent_reject").addClass("d-none");
      }
      if ($("#kaunselor_updateevent_approve").hasClass("d-none")) {
        $("#kaunselor_updateevent_approve").removeClass("d-none");
      }
      if (!$("#kaunselor_updateevent_button1").hasClass("d-none")) {
        $("#kaunselor_updateevent_button1").addClass("d-none");
      }
      if ($("#kaunselor_updateevent_button2").hasClass("d-none")) {
        $("#kaunselor_updateevent_button2").removeClass("d-none");
      }
    } else {
      if (!$("#kaunselor_updateevent_approve").hasClass("d-none")) {
        $("#kaunselor_updateevent_approve").addClass("d-none");
      }
      if ($("#kaunselor_updateevent_reject").hasClass("d-none")) {
        $("#kaunselor_updateevent_reject").removeClass("d-none");
      }

      if (!$("#kaunselor_updateevent_button2").hasClass("d-none")) {
        $("#kaunselor_updateevent_button2").addClass("d-none");
      }
      if ($("#kaunselor_updateevent_button1").hasClass("d-none")) {
        $("#kaunselor_updateevent_button1").removeClass("d-none");
      }
    }
  });

  document
    .getElementById("monthViewBtn")
    .addEventListener("click", function () {
      calendar.changeView("dayGridMonth");
    });

  document.getElementById("weekViewBtn").addEventListener("click", function () {
    calendar.changeView("timeGridWeek");
  });

  document.getElementById("dayViewBtn").addEventListener("click", function () {
    calendar.changeView("timeGridDay");
  });
  document
    .getElementById("listdayViewBtn")
    .addEventListener("click", function () {
      calendar.changeView("listDay");
    });
});
