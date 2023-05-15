<?php
    session_start();
    include "../../config/baseurl.php";
    include "../../config/db.php";

    $blog_id = $_GET["id"];
    
    if(isset($_POST["title"], $_POST["category_id"], $_POST["code"]) &&
        strlen($_POST["title"]) > 0 && strlen($_POST["code"]) > 0){

        $title = $_POST["title"];
        $code = $_POST["code"];
        $code_text = addslashes($code);
        $code_text_tr = str_replace("\n","<br>",$code_text);
        $category_id = $_POST["category_id"]; 

        $user_id = $_SESSION["id"];
        $user_nickname = $_SESSION["nickname"];

        mysqli_query($con, "UPDATE blogs
                            SET title='$title', code='$code_text_tr', category_id=$category_id
                            WHERE id=$blog_id");

        header("Location: $BASE_URL/profile.php?nickname=$user_nickname");
    }
    else{
        header("Location: $BASE_URL/edit-blog.php?id=$blog_id&error=1");
    }
?>