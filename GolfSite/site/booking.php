<!DOCTYPE html>
<html lang="en">
<?php include('../config/constants.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Adventure</title>
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="fadeIn">
    <div class="page-container">
        <div class="content-wrap">
            <header id="top">
                <header id="top">
                    <nav>
                        <div class="logo">
                            <a name="logo-link" href="#top"><img src="../images/logo.png"
                                    alt="main golf background"></a>
                        </div>
                        <div class="nav-right">
                            <a href="index.html" class="book-btn">⬅ Back</a>
                        </div>
                    </nav>
                </header>
            </header>

            <main>
            <?php
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $date = $_POST['date'];
                $time = $_POST['time'];
                $course = $_POST['course'];
                $players = $_POST['players'];
                if($name == null || $phone == null || $date == null || $time == null || $course == null || $players == null){
                    echo "<div class='center'>Please enter all information</div>";
                }
                else{
                    $sql="SELECT * FROM `bookingrequests` WHERE RequestDate = '$date' AND RequestTime = '$time' AND Course = '$course';";
                    $res=mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count>=1)
                    {
                        echo "<div class='center'>Time already booked, please book a different time!</div>";
                    }
                    else{
                        $sql = "INSERT INTO `bookingrequests` (`RequestID`, `RequesterName`, `Course`, `PhoneNumber`, `RequestDate`, `RequestTime`, `PlayersNum`) VALUES (NULL, '$name', '$course', '$phone', '$date', '$time', '$players');";
                        $res = mysqli_query($conn, $sql); //insert new order
                        echo "<div class='center'>Successfully Booked!</div>";
                    }
                }
            }?>
                <section class="booking">
                    <h2>Book Your Adventure</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">First and Last Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="000-000-0000" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="time" id="time" name="time" required>
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <select id="course" name="course" required>
                                <option value="">Select a course</option>
                                <option value="Classic">Classic Course</option>
                                <option value="Adventure">Adventure Course</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="players">Number of Players:</label>
                            <input type="number" id="players" name="players" min="1" required>
                        </div>
                        <button type="submit" name="submit" class="submit-btn">Book Now</button>
                    </form>
                </section>
            </main>
            
            <footer>
                <p>&copy; Your Adventure Golf LLC<br>615 Miamisburg Centerville Rd, Washington Township, OH 45459, USA |
                    (937)
                    999-4478</p>
            </footer>
        </div>
    </div>

    <script src="../js/smoothScroll.js"></script>
    <script src="../js/faqAccordion.js"></script>
    <script src="../js/burgerMenu.js"></script>
</body>
</html>

