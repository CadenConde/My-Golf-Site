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
            <?php
            $sql = "SELECT * FROM bookingrequests";
            $res = mysqli_query($conn, $sql);
            if ($res==TRUE)
            {
                $count = mysqli_num_rows($res);
                if ($count>0)
                {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $name = $rows['RequesterName'];
                        $id = $rows['RequestID'];
                        $date = $rows['RequestDate'];
                        $time = $rows['RequestTime'];
                        $course = $rows['Course'];
                        echo "<a href='bookingRequests.php?id=$id'> <li class='booking-request-item'><div class='booking-request-summary'><p>$name</p><p>$date $time</p><p>Course: $course</p></div></li></a>";
                    }
                }
            }
            ?>
        </ul>
    </div>

    <div class="booking-request-main">
        <div class="booking-request-content">
            <?php 
            if(isset($_GET['id'])){
                $id =  $_GET['id'];
            }
            else{
                $id = 1;
            }

            $sql = "SELECT * FROM bookingrequests WHERE RequestID = '$id'";
            $res = mysqli_query($conn, $sql);
            if ($res==TRUE)
            {
                $rows=mysqli_fetch_assoc($res);
                $name = $rows['RequesterName'];
                $date = $rows['RequestDate'];
                $time = $rows['RequestTime'];
                $course = $rows['Course'];
                $players = $rows['PlayersNum'];
                $phone = $rows['PhoneNumber'];

                $printME = "<h1>$name</h1>";
                $printME .= "<p>$date</p>";
                $printME .= "<p>Course: $course</p>";
                $printME .= "<p>Requested Time: $time</p>";
                $printME .= "<p>Players: $players</p>";
                $printME .= "<p>Phone Number: $phone</p>";
                echo $printME;
            }
            ?>
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
