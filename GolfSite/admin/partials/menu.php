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
        <?php
            $id = $_SESSION['ID'];
            $sql = "SELECT * FROM notifications WHERE employeeID = '$id' AND beenRead = '0'"; //retrive notif count
            $res=mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>99){
                $style = "font-size:12px; padding: 4px 0px";
                $count = "99+";
            }
            else if($count>9){
                $style = "font-size:15px;";
            }
            else{
                $style = "font-size:16px; padding: 2px 7px";
            }
            if($count>0){
                echo '<span class="notifbubble" style="'.$style.'">'.$count.'</span>';
            }
        ?>
        <img src="../images/icons/bell.webp" alt="Notification Image" class="nav" style="right:60px;">
    </a>

    <a href="login.php">
        <img src="../images/icons/account.webp" alt="Notification Image" class="nav" style="right:5px;">
    </a>
</section>