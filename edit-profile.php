<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";

    $user_id = $_SESSION["id"];
    $profile_details_guery = mysqli_query($con, "SELECT * FROM users WHERE id=$user_id ");
    $profile = mysqli_fetch_assoc($profile_details_guery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="edit-page">
        <form class="edit-prof edit-profile" action="<?=$BASE_URL?>/api/profile/update-profile.php" method="POST" enctype="multipart/form-data">
                    <h1>Редактирование профиля</h1>
            <div class="edit-info">
                    <p class="p-edit">Email</p>
                    <div class="login-input">
                        <input type="text" name="email" placeholder="Почта" value="<?=$profile['email']?>">
                    </div>
                    <p class="p-edit">Full name</p>
                    <div class="login-input">
                        <input type="text" name="full_name" placeholder="Полное имя" value="<?=$profile['full_name']?>">
                    </div>
                    <p class="p-edit">Nickname</p>
                    <div class="login-input">
                        <input type="text" name="nickname" placeholder="Nickname" value="<?=$profile['nickname']?>">
                    </div>
                    <p class="p-edit">Description</p>
                    <div class="login-input">
                        <input type="text" name="description" placeholder="Description" value="<?=$profile['description']?>">
                    </div>
                </div>
                <div class="edit-img">
                    <img src="images/avatars/<?=$profile['user_image']?>" alt="">
                    <button class="input-file">
                        <i class="fa-regular fa-pen-to-square"></i>
						<input type="file" class="input-input" name="user_image">
					</button>
                </div>
                <div class="edit-button">
                    <div class="linia"></div>
                    <button class="login" type="submit">Сохранить</button>
                </div>
            </form>
    </section>

    <?php
        include "views/end.php";
        include "views/modal-signin.php";
    ?>

    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>