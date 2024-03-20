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
            $password = $rows['Password']; 
            $f_name = $rows['FirstName'];
            $l_name = $rows['LastName'];
            $phone = $rows['PhoneNumber'];
            $passChange = $rows['LastPasswordChange'];

            $passChangeDate = date_create($rows['LastPasswordChange']);
            $today = date_create(date('Y-m-d'));

            $dateDiff = date_diff($passChangeDate, $today);
            $daysElapsed = intval($dateDiff->format("%d"));

            //
            

            //echo "$dateDiff days since last password change";
            $passwordLength = $rows['PasswordLength'];
        }
    }
?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div class="container">
        <h1 style="color: #90ee90; margin-top:30px">Account Settings</h1>
    </div>
        <?php

        $len = "";
        for ( //make the number of dots as password length, so we dont know the password
            $x = 0;
            $x < $passwordLength;
            $x++
        ) {
            $len .= "●";
        }

        echo "<table>"; //table
        echo "<tr> <th>Setting</th> <th>Value</th> </tr>";
        echo "<tr> <td>Username</td> <td>$user</td></tr>";
        echo "<tr> <td>First Name</td> <td>$f_name</td></tr>";
        echo "<tr> <td>Last Name</td> <td>$l_name</td></tr>";

        echo "<tr> <td>Email</td> <td>$email</td></tr>";
        echo "<tr> <td>Phone</td> <td>$phone</td></tr>";
        echo "</table>"; //end table

        echo "<table style='width: 70%; margin-bottom: 30px'>";
        echo "<tr><td style='text-align: center; width=100%'><a href='updateAccount.php'>Change Account Info</a></td></tr>";
        echo "</table><br>"; //end table
        
        if($daysElapsed > 10){
            echo "<div class='container'><p class='error'>Password $daysElapsed days old, please change it.</p></div>"; 
        }
        

        echo "<table>"; //table
        echo "<tr> <th>Password </th> <th>$len</th></tr>";
        echo "<tr> <th width='50%'>Last Changed</th> <th width='50%'>$passChange</th> </tr>";
        echo "</table>";

        echo "<table style='width: 70%'>";
        echo "<tr><td style='text-align: center; width=100%'><a href='updatePassword.php' >Change Password</a></td></tr>";
        echo "</table>"; //end table

        ?>
        <div class="container">
            <button onclick="logOut()" class="log-button">Log Out</button>
        </div>
        <script>
            function logOut(){ //logout button
                location.href = "login.php";
            }
        </script>    
</body>
<?php include('partials/footer.php'); ?>
</html>