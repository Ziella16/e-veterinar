document.addEventListener('DOMContentLoaded', () => {
    const yearElement = document.getElementById('year');
    const calendarBody = document.getElementById('calendar-body');
    const eventDateElement = document.getElementById('event-date');
    const eventList = document.getElementById('event-list');
    const addEventBtn = document.getElementById('add-event');
    const modal = document.getElementById('modal');
    const closeModal = document.querySelector('.close');
    const saveEventBtn = document.getElementById('save-event');
    const eventInput = document.getElementById('event-input');
    
    let selectedDate = null;
    let events = {};

    function generateCalendar(year) {
        const date = new Date(year, 10); // November
        const daysInMonth = new Date(year, 11, 0).getDate();
        calendarBody.innerHTML = '';
        
        let row = document.createElement('tr');
        for (let i = 1; i <= daysInMonth; i++) {
            const day = new Date(year, 10, i);
            const cell = document.createElement('td');
            cell.textContent = i;
            cell.onclick = () => selectDate(day);
            row.appendChild(cell);

            if (day.getDay() === 6) {
                calendarBody.appendChild(row);
                row = document.createElement('tr');
            }
        }
        if (row.children.length) calendarBody.appendChild(row);
    }

    function selectDate(date) {
        selectedDate = date;
        eventDateElement.textContent = `Events for ${date.toDateString()}`;
        eventList.textContent = events[date.toDateString()] || 'There are no events planned.';
        document.querySelectorAll('td').forEach(td => td.classList.remove('selected'));
        event.target.classList.add('selected');
    }

    addEventBtn.onclick = () => modal.style.display = 'flex';
    closeModal.onclick = () => modal.style.display = 'none';
    saveEventBtn.onclick = () => {
        const eventName = eventInput.value.trim();
        if (eventName && selectedDate) {
            events[selectedDate.toDateString()] = eventName;
            eventList.textContent = eventName;
            modal.style.display = 'none';
        }
    };

    document.getElementById('prev-year').onclick = () => yearElement.textContent--;
    document.getElementById('next-year').onclick = () => yearElement.textContent++;
    
    generateCalendar(2024);
});
