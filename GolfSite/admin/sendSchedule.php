<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    echo $date = $_GET['date'];
    echo $shift = $_GET['shift'];
    

    $DayOfWeek = date('l', strtotime($date));
    echo $DayOfWeek;

    $sql = "SELECT * FROM availability WHERE EmployeeID = '$id' AND DayOfWeek = '$DayOfWeek';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    if($row['available'] == 1){
        $sql = "SELECT * FROM timeoffrequests WHERE EmployeeID = '$id' AND TimeOffDate = '$date';";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==0){
            $sql = "INSERT INTO `schedule` (`ScheduleID`, `EmployeeID`, `ShiftDate`, `ShiftType`) VALUES (NULL, '$id', '$date', '$shift');";
            $res = mysqli_query($conn, $sql);
            header("location: scheduleEmployee.php");
        }
        else{
            header("location: scheduleEmployee.php?error=true");
        }
    }
    else{
        header("location: scheduleEmployee.php?error=true");
    }
    
    
    
?>