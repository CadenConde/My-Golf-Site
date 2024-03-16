<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Index</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');?>

<body class="two">
    <div class="bgImagesClubs clubFormat"></div>
    <div class="cardContainer">
        <a href="mySchedule.php"><div class="adminCard adminCard1"><p>My Schedule</p><img src="../images/icons/calendar.webp" /></div></a>
        <a href="availability.php"><div class="adminCard adminCard2"><p>Edit My Availabilty</p><img src="../images/icons/edit-calendar.webp" /></div></a>
        <a href="timeOff.php"><div class="adminCard adminCard3"><p>Time Off Requests</p><img src="../images/icons/xmark-calendar.webp" /></div></a>
        <?php
            if($_SESSION["Manager"] == true){
                echo '<a href="scheduleEmployee.php"><div class="adminCard adminCard4"><p>Schedule Employees</p><img src="../images/icons/person-calendar.webp" /></div></a>';
                echo '<a href="#"><div class="adminCard adminCard5"><p>Employee Info</p><img src="../images/icons/people.webp" /></div></a>';
                echo '<a href="booking.php"><div class="adminCard adminCard6"><p>Booking Requests</p><img src="../images/icons/bookmark.webp" /></div></a>';
            }
        ?>
    </div>
    <div class="loading-wrapper">
            <div class="loading">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <script>
            $(window).on("load", function(){
                $(".loading-wrapper").fadeOut("slow");
            })
        </script>
</body>

<?php include('partials/footer.php'); ?>
</html>
