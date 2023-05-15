<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";
    
	$id = $_GET["id"];
	$blog_details_query = mysqli_query($con, "SELECT * FROM blogs WHERE id=$id");
	$blog_details = mysqli_fetch_assoc($blog_details_query);

	$comments_query = mysqli_query($con, "SELECT * FROM comments WHERE blog_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="blog-details-page">
        <div class="edit-prof newblog">
            <div class="blog" style="width: 60%;">
                <h5 class="title"><?=$blog_details['title']?></h5>
                <div class="link-group">
                    <a class="link-like">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a class="link-like">
                        <i class="fa-solid fa-clone"></i>
                    </a>
                    <span class="link">
						<img src="images/dots.svg" alt="">
						<ul class="dropdown">
							<li> <a href="">Редактировать</a> </li>
							<li><a href="" class="danger">Удалить</a></li>
						</ul>
					</span>
                </div>
                <p class="code" type="text">
                    <?=$blog_details['code']?>
                </p>
                <div class="linia"></div>
            </div>

            <div class="blog-details-info">
                <?php   
                    if(mysqli_num_rows($comments_query) == 0){
                        echo '<h2>Пока нет комментариев!</h2>';
                    } else{
                        echo '<p class="p-edit">Kомментарии: <?=mysqli_num_rows($comments_query)?></p>';
                        while($row = mysqli_fetch_assoc($comments_query)){
                            $profile_query = mysqli_query($con, "SELECT full_name, user_image FROM users WHERE id=".$row["user_id"]);
                            $profile = mysqli_fetch_assoc($profile_query);
                ?>
                        <div class="edit-info comment">
                            <div class="comment-header">
                                <span>
                                    <img class="comment-avatar" src="images/avatars/<?=$profile['user_image']?>" alt="">
                                    <?=$profile['full_name']?>
                                </span>	
                                <?php
                                    if(isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']){
                                ?>
                                <span class="link comment-dropdown">
                                    <img src="images/dots.svg" alt="">
                                    <ul class="dropdown">
                                        <li> <a href="<?=$BASE_URL?>/blog-details.php?blog_id=<?=$row['blog_id']?>&comment_id=<?=$row['id']?>">Редактировать</a> </li>
                                        <li><a href="<?=$BASE_URL?>/api/comments/delete-comment.php?blog_id=<?=$row['id']?>" class="danger">Удалить</a></li>
                                    </ul>
                                </span>
                                <?php
                                    }
                                    else{

                                    }
                                ?>
                            </div>
                            <p class="p-edit"><?=$row['text']?></p>
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                    if(isset($_SESSION['id']) && isset($_GET['comment_id'])){
                        $comment_id = $_GET["comment_id"];
                        $comment_details_query = mysqli_query($con, "SELECT * FROM comments WHERE id=$comment_id");
                        $comment_details = mysqli_fetch_assoc($comment_details_query);
                ?>
                    <form class="edit-info comment-add" action="<?=$BASE_URL?>/api/comments/update-comment.php?comment_id=<?=$comment_id?>" method="POST">
                        <textarea name="text" class="input login-input code-textarea" placeholder="Введит текст комментария"><?=$comment_details['text']?></textarea>
                        <?php
                            if(isset($_GET["error"]) && $_GET["error"] == 1){
                                echo '<p class="text-danger">Заполните поле</p>';
                            }
			            ?>
                        <button class="login" style="width: 25%;">Отправить</button>
                    </form>
                <?php
                    } else if(isset($_SESSION["id"])){
                ?>
                    <form class="edit-info comment-add" action="<?=$BASE_URL?>/api/comments/insert-comment.php?blog_id=<?=$blog_details['id']?>" method="POST">
                        <textarea name="text" class="login-input code-textarea" placeholder="Введит текст комментария"></textarea>
                        <?php
                            if(isset($_GET["error"]) && $_GET["error"] == 1){
                                echo '<p class="text-danger">Заполните поле</p>';
                            }
			            ?>
                        <button class="login" style="width: 25%;">Отправить</button>
                    </form>
                <?php
				    } else{
			    ?>  
                    <span class="comment-warning">
                        Чтобы оставить комментарий <a href="<?=$BASE_URL?>/register.php">зарегистрируйтесь</a> , или  <a onclick="modalOpen()">войдите</a>  в аккаунт.
                    </span>
                <?php
                    }
                ?>                
            </div>
        </div>
    </section>

    <?php
        include "views/end.php";
        include "views/modal-signin.php";
    ?>
    
    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>