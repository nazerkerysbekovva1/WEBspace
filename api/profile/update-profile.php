<?php
    session_start();
    include "../../config/baseurl.php";
    include "../../config/db.php";

    if(isset( $_POST["nickname"], $_POST["full_name"], $_POST["email"], $_POST["description"]) && 
    strlen($_POST["nickname"]) > 0 && strlen($_POST["full_name"]) > 0 
    && strlen($_POST["description"]) >= 0 && strlen($_POST["email"]) > 0){
        $email = $_POST["email"];
        $user_id = $_SESSION["id"];
        $full_name = $_POST["full_name"]; 
        $nickname =  $_POST["nickname"];        
        $description = $_POST["description"];
        $desc = addslashes($description);

        $_SESSION["nickname"] = $nickname;
        $_SESSION["full_name"] = $full_name;
        $_SESSION["email"] = $email;
        $_SESSION["description"] = $description;

        if(isset($_FILES["user_image"]) && strlen($_FILES["user_image"]["name"]) > 0){
            $file_name = time() . ".";  
            $exp = explode(".", $_FILES["user_image"]["name"]);
            $ext = end($exp); 
            $file_name = $file_name . $ext; 

            move_uploaded_file($_FILES["user_image"]["tmp_name"], "../../images/avatars/$file_name");
            
            $_SESSION["user_image"] = $file_name;

            mysqli_query($con, "UPDATE users
                                SET nickname='$nickname', email='$email', full_name='$nickname', description='$desc', user_image='$file_name'
                                WHERE id=$user_id");
        }
        else{
            mysqli_query($con, "UPDATE users
                                SET nickname='$nickname', email='$email', full_name='$nickname', description='$desc'
                                WHERE id=$user_id");
        }
        header("Location: $BASE_URL/profile.php");
    }
    else{
        header("Location: $BASE_URL/edit-profile.php?error=1");
    }
?>