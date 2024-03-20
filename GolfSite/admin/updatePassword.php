<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Settings</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');
    if(isset($_SESSION['ID'])){
        $id = $_SESSION['ID'];
        $sql = "SELECT * FROM employees WHERE employeeID='$id'";
        $res = mysqli_query($conn,$sql);
        if ($res == TRUE) {
            $rows = mysqli_fetch_assoc($res);
            $password = $rows['Password']; 
            $passChange = $rows['LastPasswordChange'];
        }
    }
?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div class="settings-container">
        <h1>Change Password</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="container">

                <div class="form-row">
                    <div class="form-col">
                        <label for="email">New Password:</label>
                        <input type="password" id="newPassword" name="newPassword" value="" required>
                    </div>
                    <div class="form-col">
                        <label for="username">Retype New Password:</label>
                        <input type="password" id="newPassword2" name="newPassword2" value="" required>
                    </div>
                </div>
                
            

                <div class="form-row">
                    <div class="form-col">
                        <label for="password">Current Password:</label>
                        <input type="password" id="pass" name="pass" required>
                    </div>

                    <div class="form-col">
                        <label for="submit">Save Changes</label>
                        <input type="submit" class="save-button" id="submit" name="submit" required>
                    </div>
            
                </div>
            <div>
        </form>
        </div>

        <?php
            if(isset($_POST['submit']))
            {
                $newPass = $_POST['newPassword'];
                $newPass2 = $_POST['newPassword2'];
                
                $checkPass = $_POST['pass'];

                if(md5($checkPass) == $password){
                    if($newPass == $newPass2){
                        $length = strlen($newPass);
                        $hashedPass = md5($newPass);
                        $today = date("Y-m-d");
                        $sql = "UPDATE employees SET Password = '$hashedPass', PasswordLength = '$length', LastPasswordChange = '$today' WHERE EmployeeID = $id;";
                        $res = mysqli_query($conn, $sql) or die();
                        if ($res = TRUE)
                        {
                            echo '<script>function jsFunction(){location.href = "accountSettings.php";}';
                            echo 'jsFunction();</script>';
                        }
                        else{
                            echo "Failed to Update";
                        }
                    }
                    else{
                        echo "Passwords must match";
                    }
                }
                else{
                    echo "Passwords don't match";
                }
            }
        ?>



        <div class="loading-wrapper">
            <div class="loading">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <script>
            $(window).on("load", function(){
                $(".loading-wrapper").fadeOut("slow");
            })
        </script>
</body>
<?php include('partials/footer.php'); ?>
</html>