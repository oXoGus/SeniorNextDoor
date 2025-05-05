const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById("dates");
const prevButton = document.getElementById("prev-month");
const nextButton = document.getElementById("next-month");

let currentDate = new Date();

const events = {
    "2025-04-13": {
        title: "Chasse aux trésors",
        image: "2025-04-13.jpg",
        description: "Venez participer a notre chasse aux trésors!"
    },
    "2025-04-19": {
        title: "Concert de Jazz",
        image: "2025-04-13.jpg",
        description: "Concert de Jazz au parc!"
    },
    "2025-04-27": {
        title: "Séance de Bingo",
        image: "2025-04-13.jpg",
        description: "Venez participer a notre séance de Bingo! plein de lots a gagner!"
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
        datesHtml += `<div class="date inactive" data-date="${prevDateString}">${prevDate.getDate()}</div>`;

    }

    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? "active" : "";
        const dateString = date.toISOString().split("T")[0];
        datesHtml += `<div class="date ${activeClass}" data-date="${dateString}">${i}</div>`;
    }

    for (let i = 1; i <= 7 - lastDayIndex; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        const nextDateString = nextDate.toISOString().split("T")[0];
        datesHtml += `<div class="date inactive" data-date="${nextDateString}">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHtml;
    addHoverListeners();
}

const addHoverListeners = () => {
    const dateElements = document.querySelectorAll(".date");

    dateElements.forEach(dateElement => {
        dateElement.addEventListener("mouseenter", () => {
            const date = dateElement.getAttribute("data-date");
            console.log("Hovered date:", date);
            if (events[date]) {
                const event = events[date];
                const eventTitle = document.querySelector(".event-details-global h2");
                const eventImage = document.querySelector(".event-details-global img");
                const eventDescription = document.querySelector(".event-details-global .description p");

                eventImage.style.transition = "opacity 0.05s ease-in-out";
                eventDescription.style.transition = "opacity 0.05s ease-in-out";

                eventImage.style.opacity = 0;
                eventDescription.style.opacity = 0;

                setTimeout(() => {
                    eventTitle.textContent = event.title;
                    eventImage.src = event.image;
                    eventDescription.textContent = event.description;

                    eventImage.style.opacity = 1;
                    eventDescription.style.opacity = 1;
                }, 50);
            }
        });

        dateElement.addEventListener("mouseleave", () => {
            const date = dateElement.getAttribute("data-date");
            document.querySelector(".event-details-global .description h2").textContent = "Aucun événement"
            document.querySelector(".event-details-global img").src = "Default.png";
            document.querySelector(".event-details-global .description p").textContent = "Aucun événement trouvé pour cette date.";
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