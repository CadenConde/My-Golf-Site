// calendar.js

// Get references to relevant HTML elements
const calendarDays = document.getElementById('calendar-days');
const dayHeaders = document.getElementById('day-headers');
const shiftSelection = document.getElementById('shift-selection');
const employeeName = document.getElementById('employee-name');
const employeeInput = document.getElementById('employee-input');
const submitEmployee = document.getElementById('submit-employee');
const closeModalButtons = document.querySelectorAll('.close');
const prevMonthButton = document.getElementById('prev-month');
const nextMonthButton = document.getElementById('next-month');
const monthYearDisplay = document.getElementById('month-year');

// Array of day abbreviations for the headers
const dayAbbreviations = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];

// Initialize current date and selected day variables
let currentDate = new Date();
let selectedDay = null;

// Function to render the calendar
function renderCalendar() {
  const currentMonth = currentDate.getMonth();
  const currentYear = currentDate.getFullYear();
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

  const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

  // Clear the calendar days and headers
  calendarDays.innerHTML = '';
  dayHeaders.innerHTML = '';

  // Add day abbreviation headers
  for (let i = 0; i < 7; i++) {
    const dayHeader = document.createElement('div');
    dayHeader.textContent = dayAbbreviations[i];
    dayHeaders.appendChild(dayHeader);
  }

  // Generate calendar days
  let currentDay = 1;
  for (let i = 0; i < 6; i++) {
    for (let j = 0; j < 7; j++) {
      if (i === 0 && j < firstDayOfMonth) {
        // Add empty day for days before the first day of the month
        const emptyDay = document.createElement('div');
        emptyDay.classList.add('day', 'empty');
        calendarDays.appendChild(emptyDay);
      } else if (currentDay > daysInMonth) {
        // Stop generating days after the last day of the month
        break;
      } else {
        // Add a day element with an event listener to show the shift selection modal
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = currentDay;
        dayElement.addEventListener('click', showShiftSelection);
        calendarDays.appendChild(dayElement);
        currentDay++;
      }
    }
  }
}

// Render the initial calendar
renderCalendar();

// Event listeners for previous and next month buttons
prevMonthButton.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

nextMonthButton.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

// Function to show the shift selection modal
function showShiftSelection(event) {
  selectedDay = event.target;
  shiftSelection.style.display = 'block';
}

// Event listeners for shift buttons
const shiftButtons = shiftSelection.querySelectorAll('.shift-button');
shiftButtons.forEach(button => {
  button.addEventListener('click', showEmployeeNameInput);
});

// Function to show the employee name input modal
function showEmployeeNameInput() {
  shiftSelection.style.display = 'none';
  employeeName.style.display = 'block';
}

// Event listener for submit employee button
submitEmployee.addEventListener('click', saveSchedule);

// Function to save the schedule information
function saveSchedule() {
  const employeeName = employeeInput.value.trim();
  if (employeeName) {
    // Here, you can save the schedule information (day, shift, employee name) to a database or local storage
    console.log('Schedule saved:', employeeName, selectedDay.textContent);
    employeeInput.value = '';
    employeeName.style.display = 'none';
    selectedDay = null;
  } else {
    alert('Please enter an employee name.');
  }
}

// Event listeners for close modal buttons
closeModalButtons.forEach(button => {
  button.addEventListener('click', closeModal);
});

// Function to close the modals
function closeModal() {
  shiftSelection.style.display = 'none';
  employeeName.style.display = 'none';
}

// Event listener to close modals when clicking outside
window.addEventListener('click', function(event) {
  if (event.target == shiftSelection || event.target == employeeName) {
    closeModal();
  }
});