<?php
include('../config/constants.php');
// Retrieve the form data
$id = $_SESSION['ID'];

if(isset($_GET['Sunday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Sunday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Sunday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Monday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Monday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Monday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Tuesday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Tuesday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Tuesday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Wednesday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Wednesday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Wednesday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Thursday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Thursday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Thursday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Friday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Friday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Friday';";
}
$res = mysqli_query($conn, $sql);

if(isset($_GET['Saturday'])){
    $sql = "UPDATE availability SET available = '0' WHERE EmployeeID = '$id' AND DayOfWeek = 'Saturday';";
}
else{
    $sql = "UPDATE availability SET available = '1' WHERE EmployeeID = '$id' AND DayOfWeek = 'Saturday';";
} $Saturday = 1;

$res = mysqli_query($conn, $sql);
header("location:".SITEURL.'admin/availability.php?saved=true');

?>