<?php

    session_start();

    define('SITEURL', 'http://localhost/GolfSite/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'minibase');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();

    $db_select = mysqli_select_db($conn, DB_NAME) or die();

?>