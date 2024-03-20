 // JavaScript code
    const currentMonthElement = document.getElementById('current-month'); // Get the element to display the current month and year
    const calendarBody = document.querySelector('.calendar-body'); // Get the element that holds the calendar days
    const sidebar = document.querySelector('.sidebar'); // Get the sidebar element
    const employeeDropdown = document.getElementById('employee'); // Get the employee dropdown element
    const shiftButtons = document.querySelectorAll('.shift-buttons button'); // Get all the shift buttons
    const selectedDateInput = document.getElementById('selected-date'); // Get the hidden input for the selected date
    const dayOfYearInput = document.getElementById('day-of-year'); // Get the hidden input for the day of the year
    const dayOfWeekInput = document.getElementById('day-of-week'); // Get the hidden input for the day of the week
    const submitBtn = document.getElementById('submit-btn'); // Get the submit button

    let currentDate = new Date(); // Initialize the current date
    let selectedDate = null; // Initialize the selected date to null
    let selectedShift = null; // Initialize the selected shift to null

    function renderCalendar() {
      // Clear the calendar body before rendering the new month
      calendarBody.innerHTML = '';

      // Reset the day headers
      calendarBody.innerHTML = `
        <div class="day">Sun</div>
        <div class="day">Mon</div>
        <div class="day">Tue</div>
        <div class="day">Wed</div>
        <div class="day">Thu</div>
        <div class="day">Fri</div>
        <div class="day">Sat</div>
      `;

      const monthYear = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' }); // Get the current month and year in a readable format
      currentMonthElement.textContent = monthYear; // Display the current month and year

      const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay(); // Get the day of the week for the first day of the month
      const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate(); // Get the number of days in the current month

      let date = 1; // Start from the first day of the month
      for (let i = 0; i < 6; i++) { // Loop through 6 rows (max rows needed to display a month)
        for (let j = 0; j < 7; j++) { // Loop through 7 columns (days of the week)
          const dayElement = document.createElement('div'); // Create a new div element for the day
          dayElement.classList.add('day'); // Add the 'day' class to the div

          if (i === 0 && j < firstDayOfMonth) { // If it's the first row and before the first day of the month
            dayElement.textContent = ''; // Leave the day cell empty
          } else if (date > daysInMonth) { // If all days of the month have been rendered
            break; // Exit the inner loop
          } else {
            dayElement.textContent = date; // Set the day number in the cell
            dayElement.dataset.date = new Date(currentDate.getFullYear(), currentDate.getMonth(), date).getTime(); // Store the date as a data attribute

            if (selectedDate === dayElement.dataset.date) { // If the current day is the selected date
              dayElement.classList.add('selected'); // Add the 'selected' class to highlight the day
            }

            dayElement.addEventListener('click', () => {
              const days = document.querySelectorAll('.day'); // Get all the day elements
              days.forEach(day => day.classList.remove('selected')); // Remove the 'selected' class from all days
              dayElement.classList.add('selected'); // Add the 'selected' class to the clicked day
              selectedDate = dayElement.dataset.date; // Update the selected date
              sidebar.classList.add('active'); // Show the sidebar
            });

            date++; // Move to the next day
          }

          calendarBody.appendChild(dayElement); // Add the day element to the calendar body
        }
      }
    }

    function prevMonth() {
      currentDate.setMonth(currentDate.getMonth() - 1); // Move to the previous month
      renderCalendar(); // Re-render the calendar
    }

    function nextMonth() {
      currentDate.setMonth(currentDate.getMonth() + 1); // Move to the next month
      renderCalendar(); // Re-render the calendar
    }

    function updateSelectedDate() {
      if (selectedDate) {
        const date = new Date(parseInt(selectedDate)); // Convert the selected date to a Date object
        const dayOfYear = Math.floor((date - new Date(date.getFullYear(), 0, 0)) / (1000 * 60 * 60 * 24)); // Calculate the day of the year for the selected date
        const dayOfWeek = date.toLocaleString('default', { weekday: 'long' }); // Get the day of the week in a readable format
        selectedDateInput.value = selectedDate; // Update the value of the selected date input
        dayOfYearInput.value = dayOfYear; // Update the value of the day of the year input
        dayOfWeekInput.value = dayOfWeek; // Update the value of the day of the week input
        enableSubmitButton(); // Enable the submit button
      } else {
        selectedDateInput.value = ''; // Clear the selected date input
        dayOfYearInput.value = ''; // Clear the day of the year input
        dayOfWeekInput.value = ''; // Clear the day of the week input
        disableSubmitButton(); // Disable the submit button
      }
    }

    function enableSubmitButton() {
      submitBtn.disabled = false; // Enable the submit button
    }

    function disableSubmitButton() {
     submitBtn.disabled = true; // Disable the submit button
    }

    document.getElementById('prev-month').addEventListener('click', prevMonth); // Add an event listener for the 'Prev' button
    document.getElementById('next-month').addEventListener('click', nextMonth); // Add an event listener for the 'Next' button

    shiftButtons.forEach(button => {
      button.addEventListener('click', () => {
        shiftButtons.forEach(btn => btn.classList.remove('selected')); // Remove the 'selected' class from all shift buttons
        button.classList.add('selected'); // Add the 'selected' class to the clicked shift button
        selectedShift = button.dataset.shift; // Update the selected shift
        enableSubmitButton(); // Enable the submit button
      });
    });

    employeeDropdown.addEventListener('change', () => {
      if (employeeDropdown.value) { // If an employee is selected
        enableSubmitButton(); // Enable the submit button
      } else {
        disableSubmitButton(); // Disable the submit button
      }
    });

    renderCalendar(); // Render the initial calendar
