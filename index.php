<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";

    $blogs_per_page = 3;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="main-page">
        <div class="menu">
            <h3>Языки программирования</h3>
            <ul>
                <?php
                    $category_query = mysqli_query($con, "SELECT * FROM categories");
                    while($row = mysqli_fetch_assoc($category_query)){
                        if(isset($_GET["category_id"]) && $row["id"] ==  $_GET["category_id"]){
                            echo	'<a class="picked-link" href="'.$BASE_URL.'/?category_id='.$row["id"].'">'.$row['category_name'].'</a>';
                        }
                        else{
                            echo	'<a href="'.$BASE_URL.'/?category_id='.$row["id"].'">'.$row['category_name'].'</a>';
                        }
                    }

                ?>
            </ul>
        </div>
        <div class="main-page-inner">   
        <?php
            if(isset($_GET["category_id"])){
                $category_id = $_GET["category_id"];
                $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE category_id=$category_id ORDER BY created_at DESC LIMIT ".(($page-1)*3).", ". $blogs_per_page);
            }
            else if (isset($_POST["input-search"])){
                $search_text = $_POST["input-search"];
                $blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE title LIKE '%$search_text%' OR code LIKE '%$search_text%' ORDER BY created_at DESC LIMIT ".(($page-1)*3).", ". $blogs_per_page);
            }
            else{
                $blogs_query = mysqli_query($con, "SELECT * FROM blogs ORDER BY created_at DESC LIMIT ".(($page-1)*3).", ". $blogs_per_page);
            }
            
            $blogs_count = mysqli_num_rows($blogs_query);
            if($blogs_count == 0){
                echo '<h2 class="text-info"> пока нет постов!</h2>';
            }
            else{
                while($row = mysqli_fetch_assoc($blogs_query)){
        ?>
            <div class="blog">
                <h5 class="title"><?=$row['title']?></h5>
                <div class="link-group">
                    <?php
                        if(isset($_SESSION['id'])){
                            echo '<a href="'.$BASE_URL.'/api/favorites/insert-fav.php?blog_id='.$row['id'].'" class="link-like">';
                        } else{
                            echo '<a onclick="modalOpen()" class="link-like">';
                        }
                    ?>
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a class="link-like">
                        <i class="fa-solid fa-clone"></i>
                    </a>
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
                            echo '<a class="link" href="'.$BASE_URL.'/other-profile.php?id='.$row['user_id'].'">';
                        }
                        $user_nick_query = mysqli_query($con, "SELECT * FROM users WHERE id=" . $row['user_id']);
                        $user_nick_query_res = mysqli_fetch_assoc($user_nick_query);
                    ?>
                        <img src="images/person.svg" alt="">
                        <?php
                            echo $user_nick_query_res["full_name"];
                        ?>
                    </a>
                </div>
            </div>
        <?php
                }
            }
        ?>

            <div class="page-navigation">
            <?php
                if(isset($_GET["category_id"])){
                    $category_id = $_GET["category_id"];
                    $all_blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE category_id=$category_id ORDER BY created_at DESC");
                }
                else if (isset($_POST["input-search"])){
                    $search_text = $_POST["input-search"];
                    $all_blogs_query = mysqli_query($con, "SELECT * FROM blogs WHERE title LIKE '%$search_text%' OR code LIKE '%$search_text%' ORDER BY created_at DESC");
                }
                else{
                    $all_blogs_query = mysqli_query($con, "SELECT * FROM blogs ORDER BY created_at DESC");
                }
                
                // $blogs_query = mysqli_query($con, "SELECT * FROM blogs");
                $blogs_count = mysqli_num_rows($all_blogs_query);
                for($i=1; $i <= ceil($blogs_count/$blogs_per_page); $i++){
                    if($page == $i){
                        if(isset($_GET['category_id'])){
                            echo '<a href="'.$BASE_URL.'/?page='.($i).'&category_id='.$category_id.'" class="pages_nav_btn pages-nav-btn-active">'.($i).'</a>';
                        }
                        else if(isset($_POST['name-search'])){
                            ?>
                                <form action="<?=$BASE_URL?>/?page=<?=$i?>" method="POST">
                                    <input class="hide-input" type="text" name="name-search" id="" value="<?=$_POST['name-search']?>">
                                    <button  class="pages_nav_btn pages-nav-btn-active"> <?=$i?> </button>
                                </form>
                            <?php
                        }
                        else{
                            echo '<a href="'.$BASE_URL.'/?page='.($i).'" class="pages_nav_btn pages-nav-btn-active">'.($i).'</a>';
                        }
                    } else{
                        if(isset($_GET['category_id'])){
                            echo '<a href="'.$BASE_URL.'/?page='.($i).'&category_id='.$category_id.'" class="pages_nav_btn">'.($i).'</a>';
                        }
                        else if(isset($_POST['name-search'])){
                            ?>
                                <form action="<?=$BASE_URL?>/?page=<?=$i?>" method="POST">
                                    <input class="hide-input" type="text" name="name-search" id="" value="<?=$_POST['name-search']?>">
                                    <button  class="pages_nav_btn"> <?=$i?> </button>
                                </form>
                            <?php
                        }
                        else{
                            echo '<a href="'.$BASE_URL.'/?page='.($i).'" class="pages_nav_btn">'.($i).'</a>';
                        }
                    }
                }
            ?>
            </div>
        </div>
    </section>

    <?php
        include "views/modal-signin.php";
    ?>

    <script src="js/modal.js"></script>
    <script src="https://kit.fontawesome.com/76e801a2e4.js" crossorigin="anonymous"></script>
</body>
</html>