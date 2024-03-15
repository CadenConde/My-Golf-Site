<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time off Requests</title>
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

  <div id="date-range-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Select Date Range:</h2>
      <p id="date-range-info"></p>
      <button id="confirm-date-range">Confirm</button>
    </div>
  </div>

  <script src="../js/timeOff.js"></script>
</body>
<?php include('partials/footer.php'); ?>

</html>