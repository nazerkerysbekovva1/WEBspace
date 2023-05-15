<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";

    $user_id = $_SESSION['id'];

    $fav_query = mysqli_query($con, "SELECT * FROM favorites WHERE user_id=".$user_id);
    
    $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE user_id=$user_id ORDER BY created_at DESC");
    $blogs_count = mysqli_num_rows($blogs_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="main-page profile-page">
        <div class="profile-blog">   
            <?php
                if(isset($_GET['favorites'])){
            ?>
                    <a class="favorite-button" href="<?=$BASE_URL?>/profile.php">Мои блоги</a>  
                    <h2>Избранные</h2> 
                    <a href="<?=$BASE_URL?>/newblog.php" class="new-blog-button">Новый блог</a>  
                    <?php
                        if(mysqli_num_rows($fav_query) == 0){
                            echo '<h2 class="text-info">У вас пока нет избранных!</h2>';
                        }
                        else{
                            while($row = mysqli_fetch_assoc($fav_query)){
                                $blog_id = $row['blog_id'];
                                $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE id=$blog_id ORDER BY created_at DESC");
                                $blogs_fav = mysqli_fetch_assoc($blogs_query);
                    ?>      
                    <div class="blog">
                        <h5 class="title"><?=$blogs_fav['title']?></h5>
                        <div class="link-group">
                            <a class="link-like like-red" href="<?=$BASE_URL?>/api/favorites/delete-fav.php?blog_id=<?=$blog_id?>">
                                <i class="fa-solid fa-heart "></i>
                            </a>
                            <a class="link-like">
                                <i class="fa-solid fa-clone"></i>
                            </a>
                            <?php
                                $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE user_id=$user_id");
                                $blog_author_id = mysqli_fetch_assoc($blogs_query);
                                if($blogs_fav['id'] == $blog_author_id['id']){
                            ?>
                                <span class="link">
                                    <img src="images/dots.svg" alt="">
                                    <ul class="dropdown">
                                        <li> <a href="<?=$BASE_URL?>/edit-blog.php?id=<?=$blogs_fav['id']?>">Редактировать</a> </li>
                                        <li><a href="<?=$BASE_URL?>/api/blogs/delete-blog.php?id=<?=$blogs_fav['id']?>" class="danger">Удалить</a></li>
                                    </ul>
                                </span>
                            <?php
                                } else{
                                }
                            ?>
                        </div>
                        <p class="code" type="text">
                            <?=$blogs_fav['code']?>
                        </p>
                        <div class="blog-info">
                            <span class="link">
                                <img src="images/date.svg" alt="">
                                <?=$blogs_fav['created_at']?>
                            </span>
                            <span class="link">
                                <img src="images/visibility.svg" alt="">
                                21
                            </span>
                            <a class="link" href="<?=$BASE_URL?>/blog-details.php?id=<?=$blogs_fav['id']?>">
                                <img src="images/message.svg" alt="">
                                <?php
                                    $comments_query = mysqli_query($con, "SELECT * FROM comments WHERE blog_id=".$blogs_fav['id']);
                                    echo mysqli_num_rows($comments_query);
                                ?>
                            </a>
                            <span class="link">
                                <img src="images/forums.svg" alt="">
                                <?php
                                    $category_id = $blogs_fav["category_id"];
                                    $category_query = mysqli_query($con, "SELECT * FROM categories WHERE id=$category_id");
                                    $res = mysqli_fetch_assoc($category_query);
                                    echo $res["category_name"];
                                ?>
                            </span>
                            <?php
                                if(isset($_SESSION["id"]) && $row['user_id'] == $_SESSION["id"]){
                                    ?>
                                        <a class="link" href="<?=$BASE_URL?>/profile.php?id=<?=$row['user_id']?>">
                                    <?php
                                } else {
                                    ?>
                                        <a class="link" href="<?=$BASE_URL?>/other-profile.php?id=<?=$row['user_id']?>">
                                    <?php
                                }
                            ?>
                                <img src="images/person.svg" alt="">
                                <?php
                                    $user_nick_query = mysqli_query($con, "SELECT * FROM users WHERE id=" .$blogs_fav['user_id']);
                                    $user_nick_query_res = mysqli_fetch_assoc($user_nick_query);
                                    echo $user_nick_query_res["nickname"];
                                ?>
                            </a>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
            <?php
                } else{
            ?>
                <a class="favorite-button" href="<?=$BASE_URL?>/profile.php?favorites">Избранные</a>  
                    <h2>Мои блоги</h2> 
                    <a href="<?=$BASE_URL?>/newblog.php" class="new-blog-button">Новый блог</a>  
                    <?php           
                        if($blogs_count == 0){
                            echo '<h2 class="text-info">У вас пока нет постов!</h2>';
                        }
                        else{
                            while($row = mysqli_fetch_assoc($blogs_query)){
                    ?>      
                    <div class="blog">
                        <h5 class="title"><?=$row['title']?></h5>
                        <div class="link-group">
                            <a class="link-like" href="<?=$BASE_URL?>/api/favorites/insert-fav.php?blog_id=<?=$row['id']?>">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            <a class="link-like">
                                <i class="fa-solid fa-clone"></i>
                            </a>
                            <span class="link">
                                <img src="images/dots.svg" alt="">
                                <ul class="dropdown">
                                    <li> <a href="<?=$BASE_URL?>/edit-blog.php?id=<?=$row['id']?>">Редактировать</a> </li>
                                    <li><a href="<?=$BASE_URL?>/api/blogs/delete-blog.php?id=<?=$row['id']?>" class="danger">Удалить</a></li>
                                </ul>
                            </span>
                        </div>
                        <p class="code" type="text">
                            <?=$row['code']?>
                        </p>
                        <div class="blog-info">
                            <span class="link">
                                <img src="images/date.svg" alt="">
                                <?=$row['created_at']?>
                            </span>
                            <span class="link">
                                <img src="images/visibility.svg" alt="">
                                21
                            </span>
                            <a class="link" href="<?=$BASE_URL?>/blog-details.php?id=<?=$row['id']?>">
                                <img src="images/message.svg" alt="">
                                <?php
                                    $comments_query = mysqli_query($con, "SELECT * FROM comments WHERE blog_id=".$row['id']);
                                    echo mysqli_num_rows($comments_query);
                                ?>
                            </a>
                            <span class="link">
                                <img src="images/forums.svg" alt="">
                                <?php
                                    $category_id = $row["category_id"];
                                    $category_query = mysqli_query($con, "SELECT * FROM categories WHERE id=$category_id");
                                    $res = mysqli_fetch_assoc($category_query);
                                    echo $res["category_name"];
                                ?>
                            </span>                            
                            <?php
                                if(isset($_SESSION["id"]) && $row['user_id'] == $_SESSION["id"]){
                                    ?>
                                        <a class="link" href="<?=$BASE_URL?>/profile.php?id=<?=$row['user_id']?>">
                                    <?php
                                } else {
                                    ?>
                                        <a class="link" href="<?=$BASE_URL?>/other-profile.php?id=<?=$row['user_id']?>">
                                    <?php
                                }
                            ?>
                                <img src="images/person.svg" alt="">
                                <?php
                                    $user_nick_query = mysqli_query($con, "SELECT * FROM users WHERE id=" .$row['user_id']);
                                    $user_nick_query_res = mysqli_fetch_assoc($user_nick_query);
                                    echo $user_nick_query_res["nickname"];
                                ?>
                            </a>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                    <?php
                        }
                    ?>

        </div>

        <div class="profile-info">
            <img class="user-profile--ava" src="images/avatars/<?=$_SESSION['user_image']?>" alt="">
			<h1><?=$_SESSION["full_name"]?></h1>
            <span>@<?=$_SESSION["nickname"]?></span>
			<h2><?=$_SESSION["description"]?></h2>
			<?php
				if($blogs_count == 1){
					echo '<p>'.$blogs_count.' пост за все время</p>';
				}
				else if($blogs_count == 2){
					echo '<p>'.$blogs_count.' постa за все время</p>';
				}
				else{
					echo '<p>'.$blogs_count.' постов за все время</p>';
				}
			?>
			<a href="<?=$BASE_URL?>/edit-profile.php" class="login">Настроить профиль</a>
			<!-- <a href="<?=$BASE_URL?>/api/auth/logout.php" class="login login-danger">Выйти из аккаунта</a> -->
        </div>

    </section>

    <?php
        include "views/modal-signin.php";
    ?>

    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>