const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById("dates");
const prevButton = document.getElementById("prev-month");
const nextButton = document.getElementById("next-month");

let currentDate = new Date();

const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 0);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString("default", {
        month: "long",
        year: "numeric",
    });
    monthYearElement.textContent = monthYearString;

    let datesHtml = "";
    for (let i = firstDayIndex; i > 0; i--) {
        const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
        const prevDateString = prevDate.toISOString().split("T")[0];
        const prevDayMonthYearString = prevDate.toLocaleString("default", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
        datesHtml += `<div class="date inactive" data-date="${prevDateString}" title="${prevDayMonthYearString}">${prevDate.getDate()}</div>`;

    }

    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? "active" : "";
        const dateString = date.toISOString().split("T")[0];
        const dayMonthYearString = date.toLocaleString("default", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
        datesHtml += `<div class="date ${activeClass}" data-date="${dateString}" title="${dayMonthYearString}">${i}</div>`;
    }

    for (let i = 1; i <= 7 - lastDayIndex; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        const nextDateString = nextDate.toISOString().split("T")[0];
        const nextDayMonthYearString = nextDate.toLocaleString("default", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
        datesHtml += `<div class="date inactive" data-date="${nextDateString}" title="${nextDayMonthYearString}">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHtml;

    const calendarUpdatedEvent = new Event("calendarUpdated");
    document.dispatchEvent(calendarUpdatedEvent);
}

prevButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

nextButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

updateCalendar();