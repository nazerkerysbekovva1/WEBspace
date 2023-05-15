<?php
    session_start();
    include "config/db.php";
    include "config/baseurl.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/head.php"; ?>
</head>
<body>
    
<?php include "views/header.php"; ?>

    <section class="edit-page">
        <form class="edit-prof newblog" action="<?=$BASE_URL?>/api/blogs/insert-blog.php"  method="POST" enctype="multipart/form-data">
                    <h1>Новый блог</h1>
                <div class="edit-info">
                    <p class="p-edit">Title</p>
                    <div class="login-input">
                        <input type="text" name="title" placeholder="title" >
                    </div>
                    <p class="p-edit">Code</p>
                    <div class="input">
                        <textarea class="login-input code-textarea" name="code" id="" cols="30" rows="10" placeholder="code"></textarea>
                    </div>
                    <p class="p-edit">Category</p>
                    <div>
                        <select name="category_id" id="" class="login-input blog-catg">
                            <option>Выберите язык программирования</option>
                            <?php
                                $all_categories_query = mysqli_query($con, "SELECT * FROM categories");
                                while ($row = mysqli_fetch_assoc($all_categories_query)){
                                    echo '<option value="'.$row["id"].'">'.$row["category_name"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="edit-button">
                    <div class="linia"></div>
                    <button class="login" type="submit">Создать</button>
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