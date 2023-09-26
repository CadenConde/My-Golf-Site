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
    <a href="#">
        <img src="<?php echo SITEURL;?>/images/icons/bell.webp" alt="Notification Image" class="nav" style="height:70px; left:5px; top:0;">
    </a>
    <p>Adventure Golf 
    <?php 
    if($_SESSION["Manager"] == true){
        echo "Manager";
    }
    else{
        echo "Employee";
    }
    ?> Portal</p>
    <a href="login.php">
        <img src="<?php echo SITEURL;?>/images/icons/account.webp" alt="Notification Image" class="nav" style="height:70px; right:5px; top:0;">
    </a>
</section>