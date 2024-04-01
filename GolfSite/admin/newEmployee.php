<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Employee</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div class="settings-container">
        <h1>New Employee</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="form-row">
                    <div class="form-col">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="" required>
                    </div>
                    <div class="form-col">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="name">First Name:</label>
                        <input type="text" id="f-name" name="f-name" value=""required>
                    </div>
                    <div class="form-col">
                        <label for="name">Last Name:</label>
                        <input type="text" id="l-name" name="l-name" value="" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" value="" required>
                    </div>
                    <div class="form-col">
                        <label for="DOB">Date of Birth:</label>
                        <input type="date" id="DOB" name="DOB" value="" required>
                    </div>
                </div>
            

                <div class="form-row">
                    <div class="form-col">
                        <label for="password">Password:</label>
                        <input type="password" id="pass" name="pass" required>
                    </div>
                    <div class="form-col">
                        <label for="Account Type">Account Type</label>
                        <select name="account" id="account">
                            <option value="employee">Employee</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="form-col">
                    <label for="submit">Save Changes</label>
                    <input type="submit" class="save-button" id="submit" name="submit" required>
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
                $pass = md5($_POST['pass']);
                $type = $_POST['account'];
                $len = strlen($_POST['pass']);
               
                $sql = "INSERT INTO `employees` (`EmployeeID`, `AccountType`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `DOB`, `LastPasswordChange`, `PasswordLength`) VALUES (NULL, '$type', '$newUser', '$pass', '$newFName', '$newLName', '$newEmail', '$newPhone', '$newDOB', current_timestamp(), '$len');";
                $res = mysqli_query($conn, $sql) or die();

                $sql = "SELECT * FROM employees ORDER BY EmployeeID DESC;";
                $res = mysqli_query($conn, $sql) or die();
                $row=mysqli_fetch_assoc($res);
                $id = $row['EmployeeID'];

                $days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                for($i = 0; $i<=6; $i++){
                    $day = $days[$i];
                    $sql = "INSERT INTO `availability` (`AvailabilityID`, `EmployeeID`, `DayOfWeek`, `available`) VALUES (NULL, '$id', '$day', '1');";
                    $res = mysqli_query($conn, $sql) or die();
                }


                if ($res = TRUE)
                {
                    echo "<script>function jsFunction(){location.href = 'manageEmployees.php';}";
                    echo 'jsFunction();</script>';
                }
                else{
                    echo "Failed to Update";
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
        <?php include('partials/footer.php'); ?>
</body>

</html>