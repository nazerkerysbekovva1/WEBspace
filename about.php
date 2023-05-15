<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
    <?php include "views/header.php"; ?>

            <div class="home">
                <div class="home-inner">
                    <h3>You Are Our Priority</h3>
                    <h1>Your code is always with you when you need it</h1>
                    <p>Everytime when you work, when you walk even if you sleep</p>
                    <?php
                        if(isset($_SESSION['id'])){
                            echo '<a href="'.$BASE_URL.'/newblog.php">Начни свой блокнот</a>';
                        } else{
                            echo '<a onclick="modalOpen()">Начни свой блокнот</a>';
                        }
                    ?>
                </div>
            </div>
            
        <div class="utility">
            <h3>Чем мы полезны?</h3>
            <i>__  <i class="fa-solid fa-folder-plus"></i>  __</i>
            <p>Используя наши особенности, напиши свой собственный IT-блокнот!</p>
            <div class="use-inner">
                <div class="use-item">
                    <div class="u-img">
                        <div class="zoom"></div>
                        <img src="images/u1.jpeg" alt="">
                    </div>
                    <h2>Для ежедневных заметок, структур кода и описаний ошибок.</h2>
                </div>
                <div class="use-item">
                    <div class="u-img">
                        <div class="zoom"></div>
                        <img src="images/u2.jpeg" alt="">
                    </div>
                    <h2>Подходит для обмена вашими ресурсами.</h2>
                </div>
                <div class="use-item">
                    <div class="u-img">
                        <div class="zoom"></div>
                        <img src="images/u3.jpeg" alt="">
                    </div>
                    <h2>Позволяет держать все данные в одном месте.</h2>
                </div>
            </div>
        </div>

        <div class="prog-language">
            <div class="prog-inner prog-slider">
                <div><i class="programming lang-ruby"></i></div>
                <div><i class="programming lang-javascript"></i></div>
                <div><i class="programming lang-cpp"></i></div>
                <div><i class="programming lang-typescript"></i></div>
                <div><i class="programming lang-python"></i></div>
                <div><i class="programming lang-kotlin"></i></div>
                <div><i class="programming lang-csharp"></i></div>
                <div><i class="programming lang-go"></i></div>
                <div><i class="programming lang-php"></i></div>
            </div>
        </div>

    <?php
        include "views/end.php";
        include "views/modal-signin.php";
    ?>

    <script src="https://code.jquery.com/jquery-migrate-3.3.2.min.js" integrity="sha256-Ap4KLoCf1rXb52q+i3p0k2vjBsmownyBTE1EqlRiMwA=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>