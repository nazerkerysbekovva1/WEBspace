<?php
    include "config/baseurl.php";
?>
<div class="modal-window">
        <form class="modal-content" action="<?=$BASE_URL?>/api/auth/signin.php" method="POST">
            <div class="xmark">
                <i class="fa-solid fa-xmark" onclick="modalClose()"></i>
            </div>
            <h1>Войдите в аккаунт</h1>
            <div class="login-input">
                <input type="text" id="login-email" placeholder="Почта" name="email">
            </div>
            <div class="login-input">
                <input type="password" id="login-password" placeholder="Пароль" name="password">
            </div>
            <div class="linia"></div>
            <p id="login-error" class="text-danger"></p>
            <button class="login" id="login-button" type="button">Войти</button>
        </form>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="js/login-user.js"></script>