<?php
    include "config/baseurl.php";
    include "config/db.php";
?>
<header class="head">
        <a class="head-logo" href="<?=$BASE_URL?>/">
            <img src="images/logo/WEB-SPACE.png" alt="">
        </a>
        <form class="search"  action="<?=$BASE_URL?>/index.php" method="POST">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="input-search" placeholder="Поиск по блогам">
            <button type="submit">Найти</button>
        </form>
        <div class="head-menu">
            <a href="<?=$BASE_URL?>/about.php">О нас</a>
            <?php
                if(isset($_SESSION['id'])){
                    $user_image = $_SESSION['user_image'];
            ?>
                <a href="<?=$BASE_URL?>/api/auth/logout.php">Выйти</a>
                <a href="<?=$BASE_URL?>/profile.php" class="avatar">
                    <img src="images/avatars/<?=$user_image?>" alt="">
                </a>
            <?php
                }else{
            ?>
                <a onclick="modalOpen()">Войти</a>
                <a href="<?=$BASE_URL?>/register.php">Регистрация</a>
            <?php  
                }
            ?>
          </div>
    </header>