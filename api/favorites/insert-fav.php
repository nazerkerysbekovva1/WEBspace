<?php
    session_start();
	include "../../config/db.php";
	include "../../config/baseurl.php";

    $blog_id = $_GET["blog_id"];
    $user_id = $_SESSION["id"];

    $favorites = mysqli_query($con, "SELECT blog_id FROM favorites WHERE blog_id=".$blog_id);
    // $row = mysqli_fetch_assoc($favorites)
        if(mysqli_num_rows($favorites) == 0){
            mysqli_query($con, "INSERT INTO favorites(blog_id, user_id) 
                                    VALUES($blog_id, $user_id)");
            header("Location: $BASE_URL/profile.php?favorites&id=$blog_id"); 
        }
        else{
            header("Location: $BASE_URL/profile.php?favorites&id=$blog_id&error=1");
            // exit(); 
        }
?>