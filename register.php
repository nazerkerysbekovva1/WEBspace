<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

<?php
    include "config/baseurl.php";
?>

     <div class="register">
        <form class="register-content"action="<?=$BASE_URL?>/api/auth/signup.php" method="POST">
                <h1>Регистрация</h1>
                <div class="login-input">
                    <input type="text" name="email" placeholder="Почта или телефон">
                </div>
                <div class="login-input">
                    <input type="text" name="full_name" placeholder="Полное имя">
                </div>
                <div class="login-input">
                    <input type="text" name="nickname" placeholder="Nickname">
                </div>
                <div class="login-input">
                    <input type="password" name="password" placeholder="Введите пароль">
                </div>
                <div class="login-input">
                    <input type="password" name="password2" placeholder="Подтвердить пароль">
                </div>
                <div class="linia"></div>
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == 1){
                            echo '<p class="text-danger">Заполните все поля</p>';
                        }else if($_GET["error"] == 2){
                            echo '<p class="text-danger">Пароли не совпадают</p>';
                        }else if($_GET["error"] == 3){
                            echo '<p class="text-danger">Такой пользователь уже зарегистрирован</p>';
                        }
                    }
                ?>
                <button class="login" type="submit">Регистрация</button>
        </form>
     </div>

     <?php
        include "views/end.php";
        include "views/modal-signin.php";
    ?>

    <script src="js/slider.js"></script>
    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>