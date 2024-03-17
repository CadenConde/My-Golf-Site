<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Availabilty</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div id="availability-container">
        <h1 class="empAvailh1">Employee Availability</h1>
        <div id="day-buttons">
        <button class="day-button" data-day="Sunday">Sun</button>
        <button class="day-button" data-day="Monday">Mon</button>
        <button class="day-button" data-day="Tuesday">Tue</button>
        <button class="day-button" data-day="Wednesday">Wed</button>
        <button class="day-button" data-day="Thursday">Thu</button>
        <button class="day-button" data-day="Friday">Fri</button>
        <button class="day-button" data-day="Saturday">Sat</button>
        </div>
        <div id="availability-info"></div>
        <button id="save-availability">Save Availability</button>
    </div>
    
    <script src="../js/availability.js"></script>
</body>
<?php include('partials/footer.php'); ?>

</html>