function generateCalendar() {
    const monthElement = document.getElementById("month");
    const yearElement = document.getElementById("year");
    const daysElement = document.getElementById("days");

    const currentDate = new Date();
    let firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    let lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    monthElement.textContent = currentMonth();
    yearElement.textContent = currentDate.getFullYear();

    daysElement.innerHTML = "";

    // Populate days
    for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
        const day = document.createElement("li");
        day.textContent = i;
        daysElement.appendChild(day);
    }

    // Populate previous month's days
    for (let i = 1; i <= firstDayOfMonth.getDay(); i++) {
        const day = document.createElement("li");
        day.textContent = "";
        day.classList.add("empty");
        daysElement.insertBefore(day, daysElement.firstChild);
    }

    // Populate next month's days
    let nextMonthDay = 1;
    while (daysElement.children.length < 42) {
        const day = document.createElement("li");
        day.textContent = nextMonthDay++;
        day.classList.add("empty");
        daysElement.appendChild(day);
    }
}

function currentMonth() {
    const months = [
        "January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"
    ];
    return months[new Date().getMonth()];
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar();
}

// Initial generation
generateCalendar();
