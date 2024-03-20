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
        $status = "manager";
        $id = $_SESSION['ID'];
        $sql = "SELECT * FROM notifications WHERE beenReadManager = '0';"; //if manager get all manager notifications
    }
    else{
        $id = $_SESSION['ID'];
        $status = "employee";
        $sql = "SELECT * FROM notifications WHERE employeeID='$id' AND beenReadEmployee = '0';"; //else only employee
    }

    $res=mysqli_query($conn, $sql);

    if ($res==true)
    {
        $count = mysqli_num_rows($res);

        echo "<table>"; //table
        echo "<tr> <th>ID</th> <th>Notification</th> <th style='width: 150px;'>Mark as Read</th></tr>"; //header

        for($i = 1; $i-1<$count; $i++){ //+1 stuff so id starts at 1

            $row=mysqli_fetch_assoc($res);

            $notifId = $row['NotifID'];//just for retrieval, use this for the read button
            $content = $row['NotifContent'];
            echo "<tr> <td>$i</td> <td>$content</td> <td><button onclick='markRead($notifId,". '"' . $status . '"' .")' class='log-button no-margins'>Mark as read</button></td></tr>"; //rows
        }
        echo "</table>"; //end table
    }
    ?>
    <script>
        function markRead(id, status) {
            //document.getElementById("demo").innerHTML = status;
            //id = 1;
            //status = "manager"
            location.href = "markNotifRead.php?id="+id+"&status="+status;
        }
    </script>

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