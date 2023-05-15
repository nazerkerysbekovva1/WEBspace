<?php
    include "../../config/baseurl.php";
    include "../../config/db.php";
    
    $blog_id = $_GET["blog_id"];
    mysqli_query($con, "DELETE FROM favorites WHERE blog_id = $blog_id");
    header("Location: $BASE_URL/profile.php?favorites");
?>