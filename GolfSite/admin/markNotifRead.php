<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    echo $status = $_GET['status'];
    if ($status == "manager") {
        $sql = "UPDATE notifications SET beenReadManager = '1' WHERE notifID = '$id';";
    } else {
        $sql = "UPDATE notifications SET beenReadEmployee = '1' WHERE notifID = '$id';";
    }

    $res = mysqli_query($conn, $sql);
    header("location:".SITEURL.'admin/notifications.php');     
?>