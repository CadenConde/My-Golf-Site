<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notifications</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="../js/jquery-3.7.1.min.js"></script>
    </head>
<?php include('partials/menu.php');?>

<body class="two bgImagesClubs clubFormat">
    <?php
    if($_SESSION["Manager"] == true){
        $sql = "SELECT * FROM notifications WHERE employeeID = '1' AND beenReadManager = '0';"; //if manager get all manager notifications
    }
    else{
        $id = $_SESSION['ID'];
        $sql = "SELECT * FROM notifications WHERE employeeID='$id' AND beenReadEmployee = '0';"; //else only employee
    }

    $res=mysqli_query($conn, $sql);

    if ($res==true)
    {
        $count = mysqli_num_rows($res);

        /*ideas for this:

            -every notif will create 2 copies, an employee copy and manager copy.

            -manager copy has employeeID of 1, employee has their respective employeeID.

            -add button to mark the notif as read, maybe w/ jquery so no reload on update?

            I would like to use jquery to check the database and update the number next
            to the bell when its removed/added, but ill mess with that at some point

        */

        echo "<table>"; //table
        echo "<tr> <th>ID</th> <th>Notification</th> </tr>"; //header

        for($i = 1; $i-1<$count; $i++){ //+1 stuff so id starts at 1

            $row=mysqli_fetch_assoc($res);

            $notifId = $row['NotifID'];//just for retrieval, use this for the read button

            $content = $row['NotifContent'];
            
            echo "<tr> <td>$i</td> <td>$content</td></tr>"; //rows
        }
        echo "</table>"; //end table
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