<?php
    include "../../config/baseurl.php";
    include "../../config/db.php";

    if(isset($_POST['email'], $_POST['full_name'], $_POST['nickname'], $_POST['password'], $_POST['password2']) &&
    strlen($_POST['email']) > 4 && strlen($_POST['full_name']) > 4 && strlen($_POST['nickname']) > 4 && 
    strlen($_POST['password']) > 4 && strlen($_POST['password2']) > 4){

        $email = $_POST["email"];
        $full_name = $_POST["full_name"];
        $nickname = $_POST["nickname"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        if($password != $password2){
            header("Location: $BASE_URL/register.php?error=2");
            exit();
        }

        $user_check = mysqli_query($con, "SELECT * FROM users WHERE email='$email' OR nickname='$nickname'");
        if(mysqli_num_rows($user_check) > 0){
            header("Location: $BASE_URL/register.php?error=3");
            exit();
        }

        $hash = sha1($password);
        mysqli_query($con, "INSERT INTO users(email, full_name, nickname, password, description, user_image)
                            VALUES('$email', '$full_name', '$nickname', '$hash', '', '')");
        header("Location: $BASE_URL/index.php");  
    }
    else{
        header("Location:  $BASE_URL/register.php?error=1");
    }
?>