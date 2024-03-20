<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Scheduling Calendar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
    <?php include('partials/menu.php'); ?>
<body>
  <div class="container">
    <div class="calendar">
      <div class="calendar-header">
        <span id="current-month"></span> <!-- This span will display the current month and year -->
        <div>
          <button id="prev-month">Prev</button> <!-- Button to navigate to the previous month -->
          <button id="next-month">Next</button> <!-- Button to navigate to the next month -->
        </div>
      </div>
      <div class="calendar-body">
        <div class="day">Sun</div> <!-- Header for Sunday -->
        <div class="day">Mon</div> <!-- Header for Monday -->
        <div class="day">Tue</div> <!-- Header for Tuesday -->
        <div class="day">Wed</div> <!-- Header for Wednesday -->
        <div class="day">Thu</div> <!-- Header for Thursday -->
        <div class="day">Fri</div> <!-- Header for Friday -->
        <div class="day">Sat</div> <!-- Header for Saturday -->
      </div>
    </div>
    <div class="sidebar">
      <form id="scheduling-form" method="post" action="schedule.php"> <!-- Form to submit the scheduling data to 'schedule.php' -->
        <div class="employee-dropdown">
          <label for="employee">Select Employee:</label>
          <select id="employee" name="employee"> <!-- Dropdown to select an employee -->
            <option value="">-- Select Employee --</option>
            <!-- Add employee options here -->
          </select>
        </div>
        <div class="shift-buttons">
          <button type="button" data-shift="morning">Morning Shift</button> <!-- Button to select the morning shift -->
          <button type="button" data-shift="afternoon">Afternoon Shift</button> <!-- Button to select the afternoon shift -->
          <button type="button" data-shift="evening">Evening Shift</button> <!-- Button to select the evening shift -->
        </div>
        <input type="hidden" id="selected-date" name="selected_date" value=""> <!-- Hidden input to store the selected date -->
        <input type="hidden" id="day-of-year" name="day_of_year" value=""> <!-- Hidden input to store the day of the year for the selected date -->
        <input type="hidden" id="day-of-week" name="day_of_week" value=""> <!-- Hidden input to store the day of the week for the selected date -->
        <button type="submit" id="submit-btn" disabled>Submit</button> <!-- Submit button to submit the form (initially disabled) -->
      </form>
    </div>
  </div>
</body>
    <?php include('partials/footer.php'); ?>
</html>

