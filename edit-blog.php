<?php 
    session_start();
    include "config/baseurl.php";
    include "config/db.php";

    $blog_id = $_GET["id"];
	$blog_data_query = mysqli_query($con, "SELECT * FROM blogs WHERE id=$blog_id");
	$blog_data = mysqli_fetch_assoc($blog_data_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="edit-page">
        <form class="edit-prof newblog" action="<?=$BASE_URL?>/api/blogs/update-blog.php?id=<?=$blog_id?>" method="POST" enctype="multipart/form-data">
                    <h1>Редактирование блога</h1>
            <div class="edit-info">
                    <p class="p-edit">Title</p>
                    <div class="login-input">
                        <input type="text" name="title" placeholder="title" value="<?=$blog_data['title']?>">
                    </div>
                    <p class="p-edit">Code</p>
                    <div class="input">
                        <textarea class="login-input code-textarea" name="code" id="" cols="30" rows="10" placeholder="code" value="<?=$blog_data['code']?>"><?=$blog_data['code']?>
                        </textarea>
                    </div>
                    <p class="p-edit">Category</p>
                    <div>
                        <select name="category_id" id="" class="login-input blog-catg">
                            <?php
                                $category_name = mysqli_query($con, "SELECT * FROM categories WHERE id=".$blog_data["category_id"]);
                                $all_categories_query = mysqli_query($con, "SELECT * FROM categories");
                                $current_ctg = mysqli_fetch_assoc($category_name);
                                echo '<option>' . $current_ctg["category_name"] . '</option>';
                                while ($row = mysqli_fetch_assoc($all_categories_query)){
                                    if($current_ctg["category_name"] != $row["category_name"]){
                                        echo '<option value="' . $row["id"] . '">' . $row["category_name"] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="edit-button">
                    <div class="linia"></div>
                    <?php
                        if(isset($_GET['error']) && $_GET['error'] == 1){
                            echo '<p class="text-danger"> Заголовок и Описание не могут быть пустыми!</p>';
                        }
                    ?>
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