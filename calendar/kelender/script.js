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
    const time = document.getElementById('appointmentTime').value;

    if (title && selectedDate) {
        if (!appointments[selectedDate]) {
            appointments[selectedDate] = [];
        }

        appointments[selectedDate].push({ title, description, time });
        closeModal();
        renderCalendar();
    }
}

// Initialize the calendar on page load
renderCalendar();
