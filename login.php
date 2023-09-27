<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
        <?php include('../config/constants.php') ?>
    <body style="overflow: hidden;">
    <!--setup bg images here-->
        <div class="bgImages format2"></div>

        <div class="container">
        <img src="<?php echo SITEURL;?>/images/MainLogo.webp" alt="User Icon" style="height:150px; padding-top:20px;">
            <?php
            
            if($_SESSION["loggedIn"]){
                if($_SESSION["loggedIn"] != 1){
                    if ($_SESSION["loggedIn"] == "sorry") {
                        echo "Session Timeout, Please Log-In Again";
                    }
                }
            }

            $_SESSION["loggedIn"] = false;
            ?>

            <div class="login-container">
                
                <p class="login-title">Employee Login</p>
                <form action="" method="POST"> 
                    
                        <p class="login">Username</p>
                        <input class="login" type="text" name="username" value="">
                        <p class="login">Password</p>
                        <input class="login" type="password" name="password" value="">
                        <br>

                        <input class="submit" type="submit" name="submit" onClick="testResults(this.form)" id="test" value="Log In">
                    
                </form>
                <script>
                    function testResults (form) {
                        var button = document.getElementById("test");
                        button.style.transition = "0s";
                        button.style.transform = "translate(5px, 5px)";
                        button.style.boxShadow = "0px 0px";
                    }
                </script>
                

                <?php
                    if(isset($_POST['submit']))
                    {
                        $UsernameIn = $_POST['username'];
                
                        $sql = "SELECT * FROM employees WHERE Username='$UsernameIn'"; //retrive username
                        $res=mysqli_query($conn, $sql);

                        if ($res==true)
                        {
                            $count = mysqli_num_rows($res);
                            if ($count>=1){
                                $row=mysqli_fetch_assoc($res);

                                $username = $row['Username'];
                                $hashedPass=$row['Password'];
                                $accountType=$row['AccountType'];

                                $checkPass = md5($_POST['password']);

                                if ($checkPass == $hashedPass && $UsernameIn == $username) {
                                    $_SESSION["loggedIn"] = true;
                                    $_SESSION['timestamp'] = time();
                                    if($accountType == "Manager"){
                                        $_SESSION["Manager"] = true;
                                        header("location:" . SITEURL . 'admin/managerIndex.php'); 
                                    }
                                    else{
                                        $_SESSION["Manager"] = false;
                                        header("location:" . SITEURL . 'admin/employeeIndex.php'); 
                                    }
                                } else {
                                    echo '<p class="error">Invalid Credentials</p>';
                                }

                            }
                            else{
                                echo '<p class="error">Invalid Credentials</p>';
                            }
                        }
                    }
                ?>
            </div>
        </div>    
    </body>
</html>

