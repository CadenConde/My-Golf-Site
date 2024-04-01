<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Availabilty</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<?php include('partials/menu.php'); ?>
<?php
    $id = $_SESSION['ID'];
    $sql = "SELECT * FROM availability WHERE employeeID='$id'";

    $res = mysqli_query($conn,$sql);

    $rows = mysqli_fetch_array($res);
    $sun = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $mon = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $tues = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $wed = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $thurs = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $fri = $rows['available'];
    mysqli_next_result($conn);

    $rows = mysqli_fetch_array($res);
    $sat = $rows['available'];  
?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div id="availability-container">
        <h1 class="empAvailh1">Employee Availability</h1>
        <div id="day-buttons">
        <button class="day-button <?php if($sun == 0){echo "unavailable";}?>" data-day="Sunday">Sun</button>
        <button class="day-button <?php if($mon == 0){echo "unavailable";}?>" data-day="Monday">Mon</button>
        <button class="day-button <?php if($tues == 0){echo "unavailable";}?>" data-day="Tuesday">Tue</button>
        <button class="day-button <?php if($wed == 0){echo "unavailable";}?>" data-day="Wednesday">Wed</button>
        <button class="day-button <?php if($thurs == 0){echo "unavailable";}?>" data-day="Thursday">Thu</button>
        <button class="day-button <?php if($fri == 0){echo "unavailable";}?>" data-day="Friday">Fri</button>
        <button class="day-button <?php if($sat == 0){echo "unavailable";}?>" data-day="Saturday">Sat</button>
        </div>
        

        <div id="availability-info"></div>
       
        <button id="save-availability">Save Availability</button>

    </div>
    
    <script>
        
    </script>
    <script>
        // availability.js
        const dayButtons = document.querySelectorAll('.day-button');
        const availabilityInfo = document.getElementById('availability-info');
        const saveAvailabilityButton = document.getElementById('save-availability');

        let unavailableDays = [];

        dayButtons.forEach(button => {
            if(button.classList.contains('unavailable')){
                thisDay = button.dataset.day;
                toggleAvailability(thisDay, button);
                toggleAvailability(thisDay, button);
            }
            
            button.addEventListener('click', () => {
                const day = button.dataset.day;
                toggleAvailability(day, button);
                updateAvailabilityInfo();
            });
        });

        function toggleAvailability(day, button) {
        const isUnavailable = button.classList.contains('unavailable');

        if (isUnavailable) {
            button.classList.remove('unavailable');
            unavailableDays = unavailableDays.filter(d => d !== day);
        } else {
            button.classList.add('unavailable');
            unavailableDays.push(day);
        }
        }

        function updateAvailabilityInfo() {
        if (unavailableDays.length === 0) {
            availabilityInfo.textContent = 'You are available all days.';
        } else {
            const unavailableDaysList = unavailableDays.join(', ');
            availabilityInfo.textContent = `You are not available on: ${unavailableDaysList}.`;
        }
        
        }

        saveAvailabilityButton.addEventListener('click', () => {
        // Here, you can save the unavailable days (unavailableDays array) to a database or perform any necessary action
            //console.log('Unavailable Days:', unavailableDays);

            text = "?";
            for (let i = 0; i < unavailableDays.length; i++) {
                text += unavailableDays[i] + "=0&";
            }
            text = text.substring(0, text.length - 1);
            location.href = "save-availability.php" + text;
            //alert('Availability saved!');
        });

        function runOnLoad(){
            updateAvailabilityInfo();
            <?php
                if(isset($_SESSION['saved'])){
                    echo "availabilityInfo.textContent = 'Changes saved!'";
                    $_SESSION['saved'] = null;
                }
            ?>
        }

        window.onload = runOnLoad();
        
    </script>
</body>
<?php include('partials/footer.php'); ?>

</html>