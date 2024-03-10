<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Requests</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');?>
<body  class="two bgImagesClubs clubFormat">
    <div class="booking-request-container">
    <div class="booking-request-sidebar">
        <h1>Booking Requests</h1>
        <ul class="booking-request-list">
        <li class="booking-request-item">
            <div class="booking-request-summary">
            <p>John Doe</p>
            <p>12/12/2023</p>
            <p>Table 4</p>
            </div>
        </li>
        <li class="booking-request-item">
            <div class="booking-request-summary">
            <p>Jane Doe</p>
            <p>12/13/2023</p>
            <p>Table 6</p>
            </div>
        </li>
        <li class="booking-request-item">
            <div class="booking-request-summary">
            <p>Bob Smith</p>
            <p>12/14/2023</p>
            <p>Table 2</p>
            </div>
        </li>
        </ul>
    </div>
    <div class="booking-request-main">
        <div class="booking-request-content">
        <h1>John Doe</h1>
        <p>12/12/2023</p>
        <p>Table 4</p>
        <p>Requested Time: 7:00 PM</p>
        <p>Requested Date: 12/12/2023</p>
        <p>Message: We would like to request a table for 4 people at 7:00 PM on 12/12/2023. Thank you!</p>
        <button class="accept-button">Accept</button>
        <button class="decline-button">Decline</button>
        </div>
    </div>
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
