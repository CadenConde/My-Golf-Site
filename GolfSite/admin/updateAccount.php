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
            $id = $rows['EmployeeID'];
            $user = $rows['Username'];
            $email = $rows['Email'];
            $pass = $rows['Password'];
            $password = $rows['Password']; 
            $f_name = $rows['FirstName'];
            $l_name = $rows['LastName'];
            $phone = $rows['PhoneNumber'];
            $passChange = $rows['LastPasswordChange'];
            $DOB = $rows['DOB'];
        }
    }
?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div class="settings-container">
        <h1>Update Account</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="form-row">
                    <div class="form-col">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
                    </div>
                    <div class="form-col">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $user;?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="name">First Name:</label>
                        <input type="text" id="f-name" name="f-name" value="<?php echo $f_name;?>"required>
                    </div>
                    <div class="form-col">
                        <label for="name">Last Name:</label>
                        <input type="text" id="l-name" name="l-name" value="<?php echo $l_name;?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $phone;?>" required>
                    </div>
                    <div class="form-col">
                        <label for="DOB">Date of Birth:</label>
                        <input type="text" id="DOB" name="DOB" value="<?php echo $DOB;?>" required>
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
                $newEmail = $_POST['email'];
                $newUser = $_POST['username'];
                $newFName = $_POST['f-name'];
                $newLName = $_POST['l-name'];
                $newPhone = $_POST['phone'];
                $newDOB = $_POST['DOB'];
                $checkPass = $_POST['pass'];
                if(md5($checkPass) == $pass){
                    $sql = "UPDATE employees SET Username = '$newUser', Email = '$newEmail', FirstName = '$newFName', LastName = '$newLName', PhoneNumber = '$newPhone', DOB = '$newDOB' WHERE EmployeeID = $id;";
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