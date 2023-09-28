<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manager Index</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <?php include('partials/menu.php');
        if($_SESSION["Manager"] == false){
            header("location:" . SITEURL . 'admin/employeeIndex.php'); 
        }
    ?>

    <body style="overflow: hidden;" class="two">
        <div class="bgImagesClubs clubFormat"></div>
    </body>
        
    <?php include('partials/footer.php'); ?>
</html>