<?php
    session_start();
    include "config/baseurl.php";
    include "config/db.php";

    $other_id = $_GET["id"];
    $other_profile_query = mysqli_query($con, "SELECT full_name, description, user_image FROM users WHERE id=$other_id");
    $other_profile = mysqli_fetch_assoc($other_profile_query);
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
            <h2>Блоги пользователя <?=$other_profile["full_name"]?></h2>
            <?php
                $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE user_id=$other_id ORDER BY created_at DESC");
                $blogs_count = mysqli_num_rows($blogs_query);

                if($blogs_count == 0){
                    echo '<h2 class="text-info">Пока нет постов!</h2>';
                }
                else{
                    while($row = mysqli_fetch_assoc($blogs_query)){
            ?>
                <div class="blog">
                    <h5 class="title"><?=$row["title"]?></h5>
                    <div class="link-group">
                        <a class="link-like">
                            <i class="fa-solid fa-clone"></i>
                        </a>
                    </div>
                    <p class="code" type="text">
                        <?=$row["code"]?>
                    </p>
                    <div class="blog-info">
                        <span class="link">
                            <img src="images/date.svg" alt="">
                            <?=$row["created_at"]?>
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
                        <a class="link" href="">
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
            

            <div class="blog">
                <h5 class="title">title</h5>
                <div class="link-group">
                    <a class="link-like">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a class="link-like">
                        <i class="fa-solid fa-clone"></i>
                    </a>
                </div>
                <p class="code" type="text">
                    В последнее время все больше людей, имеющих бизнес, <br>отдают преимущество индивидуальным страницам — блогам.<br> Потому что с помощью данных ресурсов можно заниматься не<br> только продвижением собственного бренда, но также <br>продажей продукции или услуг. <br>

А еще здесь можно делиться мнением, опытом и впечатлениями. И<br> чтобы вы могли смоделировать такой проект самостоятельно, не имея опыта в <br>программировании, мы разработали конструктор сайтов для блога uBloger.<br> Он простой и понятный, поэтому работать на нем сможет каждый!

                </p>
                <div class="blog-info">
                    <span class="link">
                        <img src="images/date.svg" alt="">
                        20.02.2020
                    </span>
                    <span class="link">
                        <img src="images/visibility.svg" alt="">
                        21
                    </span>
                    <a class="link" href="">
                        <img src="images/message.svg" alt="">
                        4
                    </a>
                    <span class="link">
                        <img src="images/forums.svg" alt="">
                        category
                    </span>
                    <a class="link" href="">
                        <img src="images/person.svg" alt="">
                        avtor name
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-info">
            <img class="user-profile--ava" src="images/avatars/<?=$other_profile['user_image']?>" alt="">
			<h1><?=$other_profile["full_name"] ?></h1>
            <span>@<?=$other_profile["nickname"] ?></span>
			<h2><?=$other_profile["description"] ?></h2>
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
        </div>

    </section>

    <?php
        include "views/modal-signin.php";
    ?>

    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>