<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Settings</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');?>

<body class="two bgImagesClubs clubFormat">
    <div class="settings-container">
        <h1>Account Settings</h1>
        <form>
            <div class="form-row">
            <div class="form-col">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="admin@example.com">
            </div>
            <div class="form-col">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="Admin User">
            </div>
            </div>
            <div class="form-row">
            <div class="form-col">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="555-555-5555">
            </div>
            <div class="form-col">
                <label for="old-password"> Old Password:</label>
                <input type="password" id="old-password" name="password">
            </div>
            </div>
            <div class="form-row">
            <div class="form-col">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="admin">
            </div>
            <div class="form-col">
                <label for="new-password"> New Password:</label>
                <input type="password" id="new-password" name="password">
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

</html>