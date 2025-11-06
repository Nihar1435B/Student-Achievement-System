document.addEventListener('DOMContentLoaded', function() {
    const calendarContainer = document.getElementById('calendar');

    function renderCalendar() {
        const today = new Date();
        const currentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const daysInMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();
        const firstDayOfWeek = currentMonth.getDay();

        const header = document.createElement('div');
        header.classList.add('header');
        header.innerText = currentMonth.toLocaleString('default', { month: 'long' }) + ' ' + currentMonth.getFullYear();
        calendarContainer.innerHTML = '';
        calendarContainer.appendChild(header);

        const daysContainer = document.createElement('div');
        daysContainer.classList.add('days');

        // Create day labels
        const dayLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        for (const label of dayLabels) {
            const dayLabel = document.createElement('div');
            dayLabel.classList.add('day');
            dayLabel.innerText = label;
            daysContainer.appendChild(dayLabel);
        }

        // Create days
        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day', 'empty');
            daysContainer.appendChild(emptyDay);
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('day');
            day.innerText = i;
            daysContainer.appendChild(day);
        }

        calendarContainer.appendChild(daysContainer);
    }

    renderCalendar();
});