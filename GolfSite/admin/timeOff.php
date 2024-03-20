<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Time Off Request Calendar</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<?php include('partials/menu.php'); ?>
<body>
  <div class="container">
    <div class="calendar">
      <div class="calendar-header">
        <span id="current-month"></span>
        <div>
          <button id="prev-month">Prev</button>
          <button id="next-month">Next</button>
        </div>
      </div>
      <div class="calendar-body">
        <div class="day">Sun</div>
        <div class="day">Mon</div>
        <div class="day">Tue</div>
        <div class="day">Wed</div>
        <div class="day">Thu</div>
        <div class="day">Fri</div>
        <div class="day">Sat</div>
      </div>
    </div>
    <div class="sidebar">
      <h3>Selected Dates</h3>
      <ul class="selected-dates"></ul>
      <form id="time-off-form" action="request.php" method="post">
        <input type="hidden" id="selected-dates" name="selected_dates" value="">
        <button type="submit" class="submit-btn" disabled>Confirm Request</button>
      </form>
    </div>
  </div>
  <script src="../js/timeOff.js"></script>
</body>
<?php include('partials/footer.php'); ?>
</html>
