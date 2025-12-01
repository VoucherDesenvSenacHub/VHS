document.addEventListener("DOMContentLoaded", () => {

    let selectedDay = "";
    let selectedMonth = "";
    let selectedYear = "";
    let selectedHour = "";
    let selectedMinute = "";

    const datePanel = document.getElementById("datePanel");
    const timePanel = document.getElementById("timePanel");

    const inputDay = document.getElementById("day");
    const inputMonth = document.getElementById("month");
    const inputYear = document.getElementById("year");
    const inputHours = document.getElementById("hours");
    const inputMinutes = document.getElementById("minutes");

    const dayContainer = document.getElementById("dayList");
    const monthContainer = document.getElementById("monthList");
    const yearContainer = document.getElementById("yearList");
    const hourContainer = document.getElementById("hourList");
    const minuteContainer = document.getElementById("minuteList");

    const hiddenFinal = document.getElementById("finalDateTime");

    const months = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    months.forEach((name, index) => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = name;
        btn.dataset.month = index + 1;
        btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-center";
        monthContainer.appendChild(btn);
    });

    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y <= currentYear + 5; y++) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = y;
        btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-center";
        yearContainer.appendChild(btn);
    }

    function updateDays() {
        dayContainer.textContent = "";

        const month = parseInt(selectedMonth) || 1;
        const year = parseInt(selectedYear) || currentYear;
        const daysInMonth = new Date(year, month, 0).getDate();

        if (parseInt(selectedDay) > daysInMonth) {
            selectedDay = daysInMonth.toString();
            inputDay.value = selectedDay;
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.textContent = d.toString().padStart(2, "0");
            btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-center";
            dayContainer.appendChild(btn);
        }
    } updateDays();

    for (let h = 0; h < 24; h++) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = h.toString().padStart(2,"0");
        btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-center";
        hourContainer.appendChild(btn);
    }

    for (let m = 0; m < 60; m += 5) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = m.toString().padStart(2,"0");
        btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-center";
        minuteContainer.appendChild(btn);
    }

    function setDateTimeError(message) {
        const boxDate = document.getElementById("selectDateContainer");
        const boxTime = document.getElementById("selectTimeContainer");
        const error = document.getElementById("selectDateTimeError");

        [boxDate, boxTime].forEach(box => box.classList.add("border-red-500"));
        error.textContent = message;
        error.classList.remove("hidden");
    }

    [inputDay, inputMonth, inputYear].forEach(input => {
        input.addEventListener("click", (e) => {
            e.stopPropagation();
            datePanel.classList.toggle("hidden");
            timePanel.classList.add("hidden");
        });
    });

    [inputHours, inputMinutes].forEach(input => {
        input.addEventListener("click", (e) => {
            e.stopPropagation();
            timePanel.classList.toggle("hidden");
            datePanel.classList.add("hidden");
        });
    });

    document.addEventListener("click", (e) => {
        if (!datePanel.contains(e.target) &&
            ![inputDay, inputMonth, inputYear].includes(e.target)) {
            datePanel.classList.add("hidden");
        }

        if (!timePanel.contains(e.target) &&
            ![inputHours, inputMinutes].includes(e.target)) {
            timePanel.classList.add("hidden");
        }
    });

    document.addEventListener("click", (e) => {
        const d = e.target.closest("#dayList button");
        if (d) {
            selectedDay = d.textContent;
            inputDay.value = selectedDay;
        }

        const m = e.target.closest("#monthList button");
        if (m) {
            selectedMonth = m.dataset.month;
            inputMonth.value = m.textContent;
            updateDays();
        }

        const y = e.target.closest("#yearList button");
        if (y) {
            selectedYear = y.textContent;
            inputYear.value = selectedYear;
            updateDays();
        }
    });

    document.addEventListener("click", (e) => {
        const h = e.target.closest("#hourList button");
        if (h) {
            selectedHour = h.textContent;
            inputHours.value = selectedHour;
        }

        const mi = e.target.closest("#minuteList button");
        if (mi) {
            selectedMinute = mi.textContent;
            inputMinutes.value = selectedMinute;
        }
    });

    document.getElementById("eventForm")?.addEventListener("submit", () => {
        if (!selectedDay || !selectedMonth || !selectedYear) {
            setDateTimeError("Selecione uma data completa.");
            return false;
        }

        if (!selectedHour || !selectedMinute) {
            setDateTimeError("Selecione um horário completo.");
            return false;
        }

        const chosenDate = new Date(
            selectedYear,
            selectedMonth - 1,
            selectedDay,
            selectedHour,
            selectedMinute
        );

        const now = new Date();

        if (chosenDate <= now) {
            setDateTimeError("A data é inválida");
            return false;
        }

        const final = `${selectedYear}-${selectedMonth.padStart(2,"0")}-${selectedDay.padStart(2,"0")} ${selectedHour.padStart(2,"0")}:${selectedMinute.padStart(2,"0")}:00`;
        hiddenFinal.value = final;
    });

});