<?php

if(isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];

}

global $connection;
$query = "SELECT * FROM posts";
$select_posts = mysqli_query($connection , $query);

while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
    $post_content = mysqli_real_escape_string($connection , $post_content);
}

if(isset($_POST['update_post'])) {

    $post_user = $_POST['post_user'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection , $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }

    }


    $query = "UPDATE posts SET ";
    $query .="post_title = '{$post_title}', ";
    $query .="post_category_id = '{$post_category_id}', ";
    $query .="post_date = now(), ";
    $query .="post_user = '{$post_user}', ";
    $query .="post_status = '{$post_status}', ";
    $query .="post_tags ='{$post_tags}', ";
    $query .="post_content ='{$post_content}', ";
    $query .="post_image ='{$post_image}' ";
    $query .="WHERE post_id = {$the_post_id} ";
    $update_query = mysqli_query($connection , $query);

    confirmQuery($update_query);
    echo "<h4 class='bg-success'>Postare actualizata! <a href='../post.php?p_id=$the_post_id'>Vezi postarea</a> sau <a href='posts.php'>Editeaza alte postari</a></h4>";
}



?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Titlul Postarii</label>
        <input value="<?php echo $post_title;?>"type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="categories">Categorii</label>
        <select name="post_category" id="">
            <?php
             $query = "SELECT * FROM categories ";
             $select_categories = mysqli_query($connection, $query);
             confirmQuery($select_categories);


            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'> $cat_title </option>";
            }
            ?>
        </select>
    </div>



    <div class="form-group">
        <label for="users">Utilizatori</label>
        <select name="post_user" id="">
            <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>

            <?php

            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);

            while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='$username'>{$username}</option>";
            }

            ?>



        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="post_category">Post Status</label>-->
<!--        <input value="--><?php //echo $post_status;?><!--"type="text" class="form-control" name="post_status">-->
<!--    </div>-->
    <div class="form-group">
    <label for="post_status">Statusul Postarii</label>
    <select name="post_status" id="">
        <option value="<?php echo $post_status; ?>"><?php echo $post_status;?></option>

        <?php
        if($post_status == 'published') {
            echo "<option value='draft'>In lucru</option>";
        } else {
            echo "<option value='published'>Publica</option>";
        }
        ?>

        <?php

        if(isset($_POST['delete_post'])) {
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $delete_query = mysqli_query($connection , $query);
            if(!$delete_query)die('QUERY FAILED'. mysqli_error($connection));
            header('Location: posts.php');
        }

        ?>

    </select>
    </div>

    <div class="form-group">
        <label for="title">Imaginea Postarii</label>
        <input width="100" src="../images/<?php echo $post_image;?>" type="file"  name="image">
    </div>

    <div class="form-group">
        <label  for="post_category">Taguri</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="title">Continut</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
        <input style="background-color: red; border: 1px solid transparent" class="btn btn-primary" type="submit" name="delete_post" value="Delete Post">
    </div>



</form>