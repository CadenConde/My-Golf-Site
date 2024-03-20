// schedule.js
// Get elements from the DOM
const currentMonthElement = document.getElementById('current-month');
const calendarBody = document.querySelector('.calendar-body');
const sidebar = document.querySelector('.sidebar');
const selectedDatesElement = document.querySelector('.selected-dates');
const selectedDatesInput = document.getElementById('selected-dates');
const submitBtn = document.querySelector('.submit-btn');

// Initialize variables
let currentDate = new Date();
let selectedDates = [];

// Render the calendar based on the current date
function renderCalendar() {
  calendarBody.innerHTML = '';
  calendarBody.innerHTML = `
    <div class="day">Sun</div>
    <div class="day">Mon</div>
    <div class="day">Tue</div>
    <div class="day">Wed</div>
    <div class="day">Thu</div>
    <div class="day">Fri</div>
    <div class="day">Sat</div>
  `;

  const monthYear = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
  currentMonthElement.textContent = monthYear;

  const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
  const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

  let date = 1;
  for (let i = 0; i < 6; i++) {
    for (let j = 0; j < 7; j++) {
      const dayElement = document.createElement('div');
      dayElement.classList.add('day');

      if (i === 0 && j < firstDayOfMonth) {
        dayElement.textContent = '';
      } else if (date > daysInMonth) {
        break;
      } else {
        dayElement.textContent = date;
        dayElement.dataset.date = new Date(currentDate.getFullYear(), currentDate.getMonth(), date).getTime();

        if (selectedDates.includes(dayElement.dataset.date)) {
          dayElement.classList.add('selected');
        }

        dayElement.addEventListener('click', () => {
          dayElement.classList.toggle('selected');
          const dateIndex = selectedDates.indexOf(dayElement.dataset.date);
          if (dateIndex === -1) {
            selectedDates.push(dayElement.dataset.date);
          } else {
            selectedDates.splice(dateIndex, 1);
          }
          renderSelectedDates();
          updateSubmitButton();
        });

        date++;
      }

      calendarBody.appendChild(dayElement);
    }
  }
}

// Move to the previous month
function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
}

// Move to the next month
function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
}

// Render the selected dates in the sidebar
function renderSelectedDates() {
  selectedDatesElement.innerHTML = '';
  selectedDates.forEach(date => {
    const dateObj = new Date(parseInt(date));
    const dateString = dateObj.toLocaleDateString();
    const li = document.createElement('li');
    li.textContent = dateString;
    li.appendChild(createRemoveButton(date));
    selectedDatesElement.appendChild(li);
  });
  
  // Show or hide the sidebar based on the number of selected dates
  sidebar.classList.toggle('active', selectedDates.length > 0);
  
  updateSelectedDatesInput();

  // Unhighlight removed dates on the calendar
  const days = document.querySelectorAll('.day');
  days.forEach(day => {
    if (!selectedDates.includes(day.dataset.date)) {
      day.classList.remove('selected');
    }
  });
}

// Create a remove button for each selected date
function createRemoveButton(date) {
  const removeButton = document.createElement('button');
  removeButton.textContent = 'Remove';
  removeButton.addEventListener('click', () => {
    const dateIndex = selectedDates.indexOf(date);
    selectedDates.splice(dateIndex, 1);
    renderSelectedDates();
    updateSubmitButton();
  });
  return removeButton;
}

// Update the hidden input field with the selected dates
function updateSelectedDatesInput() {
  selectedDatesInput.value = selectedDates.join(',');
}

// Enable or disable the submit button based on the number of selected dates
function updateSubmitButton() {
  submitBtn.disabled = selectedDates.length === 0;
}

// Event listeners for the previous and next month buttons
document.getElementById('prev-month').addEventListener('click', prevMonth);
document.getElementById('next-month').addEventListener('click', nextMonth);

// Initial render of the calendar
renderCalendar();
