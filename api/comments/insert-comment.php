<?php
    session_start();
	include "../../config/db.php";
	include "../../config/baseurl.php";

    $blog_id = $_GET["blog_id"];
    $user_id = $_SESSION["id"];
    $text = $_POST["text"];

    if(isset($_POST["text"]) && strlen($_POST["text"]) > 0){
        mysqli_query($con, "INSERT INTO comments(user_id, blog_id, text) 
                                VALUES($user_id, $blog_id, '$text')");
         header("Location: $BASE_URL/blog-details.php?id=$blog_id");
    }
    else{
        header("Location: $BASE_URL/blog-details.php?id=$blog_id&error=1");
    }
?>