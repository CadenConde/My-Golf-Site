<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
    <?php include('../config/constants.php') ?>
<body style="overflow: hidden;" class="one">
    <div class="container">
    <div class="bgImages format2"></div>
    <img src="../images/MainLogo.webp" alt="User Icon" style="height:150px; padding-top:20px;">
        <div class="login-container">
            <p class="login-title">Employee Login</p>
            <form action="" method="POST"> 
            <div class="input-box">
                <input type="text" name="username" required>
                <label> Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label> Password</label>
            </div>

                    <input class="submit" type="submit" name="submit" onClick="testResults(this.form)" id="test" value="Log In">
            </form>
            
            <?php
                
                if($_SESSION["loggedIn"] != 1){
                    if ($_SESSION["loggedIn"] == "sorry") {
                        echo '<p class="error">Session Timeout, Please Log-In Again</p>';
                    } 
                }
                $_SESSION["loggedIn"] = "no";
            ?>
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
                                $_SESSION['ID'] = $row['EmployeeID'];;
                                $_SESSION['timestamp'] = time();
                                if($accountType == "Manager"){
                                    $_SESSION["Manager"] = true;
                                }
                                else{
                                    $_SESSION["Manager"] = false;
                                }
                                header("location:" . SITEURL . 'admin/employeeIndex.php'); 
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

