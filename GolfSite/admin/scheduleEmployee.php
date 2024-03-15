<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Employees</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
<div id="calendar-container">
    <div id="calendar-header">
      <button id="prev-month">&larr;</button>
      <h2 id="month-year"></h2>
      <button id="next-month">&rarr;</button>
    </div>
    <div id="calendar">
      <div id="day-headers"></div>
      <div id="calendar-days"></div>
    </div>
  </div>

  <div id="shift-selection" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Select a shift:</h2>
      <button id="morning-shift" class="shift-button">12:00-3:00</button>
      <button id="afternoon-shift" class="shift-button">3:00-6:00</button>
      <button id="night-shift" class="shift-button">6:00-9:00</button>
    </div>
  </div>
  <div id="employee-name" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Enter employee name:</h2>
      <input type="text" id="employee-input" placeholder="Employee Name">
      <button id="submit-employee">Submit</button>
    </div>
  </div>

  <script src="../js/calendar.js"></script>

</body>
<?php include('partials/footer.php'); ?>

</html>