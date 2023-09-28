<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Index</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
<?php include('partials/menu.php');?>

<body style="overflow: hidden" class="two">
    <div class="bgImagesClubs clubFormat"></div>
    <div class="cardContainer">
        <a href="#"><div class="adminCard">My Schedule</div></a>
        <a href="#"><div class="adminCard">Edit My Availibilty</div></a>
        <a href="#"><div class="adminCard">Time Off Requests</div></a>
        <?php
            if($_SESSION["Manager"] == true){
                echo '<a href="#"><div class="adminCard">Schedule Employees</div></a>';
                echo '<a href="#"><div class="adminCard">Employee Info</div></a>';
                echo '<a href="#"><div class="adminCard">Booking Requests</div></a>';
            }
        ?>
    </div>
</body>

<?php include('partials/footer.php'); ?>
</html>
