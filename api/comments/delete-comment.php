<?php
    session_start();
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $comment_id = $_GET["blog_id"];

    $blog_details_query = mysqli_query($con, "SELECT blog_id FROM comments WHERE id=$comment_id");
    $blog_id = mysqli_fetch_assoc($blog_details_query)["blog_id"];

    mysqli_query($con, "DELETE FROM comments WHERE id=$comment_id");
    header("Location: $BASE_URL/blog-details.php?id=$blog_id");
?>