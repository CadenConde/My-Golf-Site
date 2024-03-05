<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Index</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
<?php include('partials/menu.php');?>

<body class="two">
    <div class="bgImagesClubs clubFormat"></div>
    <div class="cardContainer">
        <a href="#"><div class="adminCard adminCard1">My Schedule<img src="../images/icons/calendar.webp" /></div></a>
        <a href="availability.php"><div class="adminCard adminCard2">Edit My Availabilty<img src="../images/icons/edit-calendar.webp" /></div></a>
        <a href="#"><div class="adminCard adminCard3">Time Off Requests<img src="../images/icons/xmark-calendar.webp" /></div></a>
        <?php
            if($_SESSION["Manager"] == true){
                echo '<a href="#"><div class="adminCard adminCard4">Schedule Employees<img src="../images/icons/person-calendar.webp" /></div></a>';
                echo '<a href="#"><div class="adminCard adminCard5">Employee Info<img src="../images/icons/people.webp" /></div></a>';
                echo '<a href="#"><div class="adminCard adminCard6">Booking Requests<img src="../images/icons/bookmark.webp" /></div></a>';
            }
        ?>
    </div>
</body>

<?php include('partials/footer.php'); ?>
</html>
