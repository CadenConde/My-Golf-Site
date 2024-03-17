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
            $passChange = $rows['LastPasswordChange'] ;
            
        }
    }

?>

<body class="two">
<div class="bgImagesClubs clubFormat"></div>
    <div class="settings-container">
        <h1>Account Settings</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
            <div class="form-col">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="" required>
            </div>
            <div class="form-col">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-col">
                <label for="old-password"> Old Password:</label>
                <input type="password" id="old-password" name="password" required>
            </div>
            <div class="form-col">
                <label for="new-password"> New Password:</label>
                <input type="password" id="new-password" name="password" >
            </div>
            </div>
            <div class="form-row">
            <div class="form-col">
                <label for="name">First Name:</label>
                <input type="text" id="f-name" name="f-name" required>
            </div>
            <div class="form-col">
                <label for="name">Last Name:</label>
                <input type="text" id="l-name" name="l-name" required>
            </div>
            </div>
            <div class="form-row">
            <div class="form-col">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            </div>
            <button type="submit" class="save-button">Save</button>
        </form>
        </div>
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