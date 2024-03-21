// calendar.js
const calendarDays = document.getElementById('calendar-days');
const dayHeaders = document.getElementById('day-headers');
const dateRangeModal = document.getElementById('date-range-modal');
const dateRangeInfo = document.getElementById('date-range-info');
const confirmDateRange = document.getElementById('confirm-date-range');
const closeModalButtons = document.querySelectorAll('.close');
const prevMonthButton = document.getElementById('prev-month');
const nextMonthButton = document.getElementById('next-month');
const monthYearDisplay = document.getElementById('month-year');

const dayAbbreviations = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];

let currentDate = new Date();
let startDate = null;
let endDate = null;

function renderCalendar() {
  const currentMonth = currentDate.getMonth();
  const currentYear = currentDate.getFullYear();
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

  const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

  calendarDays.innerHTML = '';
  dayHeaders.innerHTML = '';

  for (let i = 0; i < 7; i++) {
    const dayHeader = document.createElement('div');
    dayHeader.textContent = dayAbbreviations[i];
    dayHeaders.appendChild(dayHeader);
  }

  let currentDay = 1;
  for (let i = 0; i < 6; i++) {
    for (let j = 0; j < 7; j++) {
      if (i === 0 && j < firstDayOfMonth) {
        const emptyDay = document.createElement('div');
        emptyDay.classList.add('day', 'empty');
        calendarDays.appendChild(emptyDay);
      } else if (currentDay > daysInMonth) {
        break;
      } else {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = currentDay;
        dayElement.addEventListener('click', selectDay);

        const date = new Date(currentYear, currentMonth, currentDay);
        if (startDate && endDate && date >= startDate && date <= endDate) {
          dayElement.classList.add('in-range');
        } else if (date.getTime() === startDate?.getTime()) {
          dayElement.classList.add('selected');
        } else if (date.getTime() === endDate?.getTime()) {
          dayElement.classList.add('selected');
        }

        calendarDays.appendChild(dayElement);
        currentDay++;
      }
    }
  }
}

renderCalendar();

prevMonthButton.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

nextMonthButton.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

function selectDay(event) {
  const selectedDay = event.target;
  const selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), selectedDay.textContent);

  if (!startDate) {
    startDate = selectedDate;
    selectedDay.classList.add('selected');
  } else if (!endDate) {
    endDate = selectedDate;
    selectedDay.classList.add('selected');
    showDateRangeModal();
  } else {
    resetDateRange();
    startDate = selectedDate;
    selectedDay.classList.add('selected');
  }

  updateDateRange();
  renderCalendar();
}

function showDateRangeModal() {
  dateRangeModal.style.display = 'block';
}

function resetDateRange() {
  startDate = null;
  endDate = null;
  const selectedDays = document.querySelectorAll('.selected');
  selectedDays.forEach(day => day.classList.remove('selected'));
  const inRangeDays = document.querySelectorAll('.in-range');
  inRangeDays.forEach(day => day.classList.remove('in-range'));
}

function updateDateRange() {
  if (startDate && endDate) {
    dateRangeInfo.textContent = `Start Date: ${startDate.toLocaleDateString()} - End Date: ${endDate.toLocaleDateString()}`;
  } else if (startDate) {
    dateRangeInfo.textContent = `Start Date: ${startDate.toLocaleDateString()}`;
  } else {
    dateRangeInfo.textContent = '';
  }
}

confirmDateRange.addEventListener('click', () => {
  if (startDate && endDate) {
    // Here, you can save the date range or perform any necessary action
    console.log('Date Range:', startDate, endDate);
    dateRangeModal.style.display = 'none';
    resetDateRange();
  }
});

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    dateRangeModal.style.display = 'none';
  });
});

window.addEventListener('click', function(event) {
  if (event.target == dateRangeModal) {
    dateRangeModal.style.display = 'none';
  }
});