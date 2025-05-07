const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById("dates");
const prevButton = document.getElementById("prev-month");
const nextButton = document.getElementById("next-month");

let currentDate = new Date();

const events = {
    "2025-04-13": {
        description: "Garder les petits enfants"
    },
    "2025-04-19": {
        description: "Anniversaire de Huguette la voisine."
    },
    "2025-04-27": {
        description: "séance de pilate avec les copines du club med."
    }
};

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
    addHoverListeners();
}

const addHoverListeners = () => {
    const dateElements = document.querySelectorAll(".date");

    dateElements.forEach(dateElement => {
        dateElement.addEventListener("mouseenter", () => {
            const date = dateElement.getAttribute("data-date");
            const title = dateElement.getAttribute("title");
            console.log("Hovered date:", date);
            if (events[date]) {
                const event = events[date];
                const eventTitle = document.querySelector(".event-details-perso h2");
                const eventDescription = document.querySelector(".event-details-perso .description p");

                eventDescription.style.transition = "opacity 0.05s ease-in-out";

                eventDescription.style.opacity = 0;

                setTimeout(() => {
                    eventTitle.textContent = title;
                    eventDescription.textContent = event.description;

                    eventDescription.style.opacity = 1;
                }, 50);
            } else {
                const title = dateElement.getAttribute("title");
                document.querySelector(".event-details-perso .description h2").textContent = title;
                document.querySelector(".event-details-perso .description p").textContent = "Aucun événement trouvé pour cette date.";
            }
        });
    });
};

prevButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

nextButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

updateCalendar();