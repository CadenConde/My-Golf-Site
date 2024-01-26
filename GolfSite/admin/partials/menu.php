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
<head>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<section class="navBar">
    <a href= "employeeIndex.php">
        <p>
        <?php 
        if($_SESSION["Manager"] == true){
            echo "Manager";
        }
        else{
            echo "Employee";
        }
        ?> Portal</p>
    </a>
   
    <a href="notifications.php">
        <?php
            $id = $_SESSION['ID'];
            $sql = "SELECT * FROM notifications WHERE employeeID = '$id' AND beenReadEmployee = '0'"; //retrive notif count
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
    


    <div class="action">
        <div class="profile" onclick="menuToggle();">
            <img src="../images/icons/account.webp" alt="Profile picture">
        </div>
        <div class="menu">
            <h3>
                <?php ?>
                <div>Status: 
                    <?php
                        if($_SESSION["Manager"] == true){
                            echo "Manager";
                        }
                        else{
                            echo "Employee";
                        }
                    ?>
                </div>
            </h3>
            <ul>
                <li>
                <span class="material-symbols-outlined">settings</span>
                    <a href="<?php SITEURL?>settings.php">Settings</a>
                </li>
                <li>
                <span class="material-symbols-outlined">dashboard</span>
                    <a href="<?php SITEURL?>employeeindex.php">Dashboard</a>
                </li>
                <li>
                <span class="material-symbols-outlined">logout</span>
                    <a href="<?php SITEURL?>login.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        const toggleMenu = document.querySelector('.menu');

        function menuToggle(event) {
            event.stopPropagation(); // Prevents the click event from propagating to the document
            toggleMenu.classList.toggle('active');
        }

        function closeMenu(event) {
            if (toggleMenu.classList.contains('active') && !toggleMenu.contains(event.target)) {
                toggleMenu.classList.remove('active');
            }
        }

        // Toggle the menu when clicking on the profile icon
        document.querySelector('.profile').addEventListener('click', menuToggle);

        // Close the menu when clicking outside the menu or on the profile icon again
        document.addEventListener('click', closeMenu);

    </script>

    <!--<div>
        <img src="../images/icons/account.webp" alt="Notification Image" class="nav" style="right:5px;">
        <h3>User Account</h3>
        <div></div>
    </div>-->
</section>