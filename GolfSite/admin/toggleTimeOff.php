<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    echo $date = date($_GET['date']);

    echo $sql = "SELECT * FROM timeoffrequests WHERE EmployeeID = '$id' AND TimeOffDate = '$date';";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $count=mysqli_num_rows($res);

    echo "<br>$count";
    if($count>0){
        $rid = $row['TimeOffRequestID'];
        $sql = "DELETE FROM timeoffrequests WHERE TimeOffRequestID = $rid";
        $res = mysqli_query($conn, $sql);
        header('location: timeOff.php');
    }
    else{
        $sql = "INSERT INTO `timeoffrequests` (`TimeOffRequestID`, `EmployeeID`, `TimeOffDate`) VALUES (NULL, '$id', '$date');";
        $res = mysqli_query($conn, $sql) or die();
        header('location: timeOff.php');
    }
?>