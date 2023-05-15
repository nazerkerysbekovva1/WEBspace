<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $con = mysqli_connect("localhost", "root", "", "web-space");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySql:".mysqli_connect_error();
        exit();
    }
?>