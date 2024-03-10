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
    <div>
        <div class="notifications-container">
        <div class="notifications-sidebar">
            <div class="notifications-header">
            <h1>Notifications</h1>
            <div class="filter-buttons">
                <button class="filter-button" data-filter="all">All</button>
                <button class="filter-button-unread" data-filter="unread">Unread</button>
                <button class="filter-button" data-filter="read">Read</button>
            </div>
            </div>
            <ul class="notifications-list">
            <li class="notification-item unread">
                <div class="notification-summary">
                <p>You have a new message from John Doe</p>
                <p>Subject: Meeting at 2pm</p>
                </div>
            </li>
            <li class="notification-item read">
                <div class="notification-summary">
                <p>You have a new message from Jane Doe</p>
                <p>Subject: Project Update</p>
                </div>
            </li>
            <li class="notification-item unread">
                <div class="notification-summary">
                <p>You have a new message from Bob Smith</p>
                <p>Subject: Urgent Bug Fix</p>
                </div>
            </li>
            </ul>
        </div>
        <div class="notifications-main">
            <div class="notification-content">
            <p>You have a new message from John Doe</p>
            <p>Subject: Meeting at 2pm</p>
            <p>Message: Hi there, I just wanted to confirm our meeting at 2pm today. Let me know if you need to reschedule.</p>
            <p>Sent: 10:30am</p>
            </div>
        </div>
    </div>
    </div>
    <?php
    if($_SESSION["Manager"] == true){
        $sql = "SELECT * FROM notifications WHERE employeeID = '1' AND beenReadManager = '0';"; //if manager get all manager notifications
    }
    else{
        $id = $_SESSION['ID'];
        $sql = "SELECT * FROM notifications WHERE employeeID='$id' AND beenReadEmployee = 0;"; //else only employee
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
        echo "<tr> <th>ID</th> <th>Content</th> </tr>"; //header

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