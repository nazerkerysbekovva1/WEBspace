<?php
    session_start();
    session_destroy();
    
    include "../../config/baseurl.php";
    header("Location: $BASE_URL/");  //modal-window
?>