<?php include('../config/constants.php') ?>
<?php //Session Timeout Code
    if ($_SESSION["loggedIn"] == null) {
        header("location:".SITEURL.'admin/login.php');
        $_SESSION["loggedIn"] = false;
        $_SESSION['timestamp'] = time();
    }
    else if((time() - $_SESSION['timestamp'])> 900) { /* If no activity for 15 min, timeout */
        $_SESSION["loggedIn"] = "sorry";
        header("location:".SITEURL.'admin/login.php');
    }
    if ($_SESSION["loggedIn"] == false) {
        header("location:".SITEURL.'admin/login.php');
    }
    else {
        $_SESSION['timestamp'] = time();
    } 
?>

<section class="navBar">
    
    <p>Adventure Golf 
    <?php 
    if($_SESSION["Manager"] == true){
        echo "Manager";
    }
    else{
        echo "Employee";
    }
    ?> Portal</p>
    
    <a href="#">
        <img src="../images/icons/bell.webp" alt="Notification Image" class="nav" style="right:60px;">
    </a>
    <a href="login.php">
        <img src="../images/icons/account.webp" alt="Notification Image" class="nav" style="right:5px;">
    </a>
</section>