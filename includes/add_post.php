
<?php

  if(isset($_POST['create_post'])) {

      global $connection;

      $post_title = $_POST['title'];
      $post_user = $_SESSION['username'];
      $post_user_id = $_SESSION['user_id'];
      $post_category_id = $_POST['post_category_id'];
      $post_status = $_POST['post_status'];
      $post_image = $_FILES['image']['name'];
      $post_image_temp = $_FILES['image']['tmp_name'];
      $post_tags = $_POST['post_tags'];
      $post_content = $_POST['post_content'];
      $post_date = date('d-m-y');
//      $post_comment_count = 4;
      $post_content = mysqli_real_escape_string($connection, $post_content);
      move_uploaded_file($post_image_temp, "../images/$post_image");

      $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image,post_content,post_tags,post_status, post_user_id) VALUES ('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}', '{$post_tags}','{$post_status}', {$post_user_id}) ";


      $create_post_query = mysqli_query($connection, $query);

      confirmQuery($create_post_query);
      $the_post_id = mysqli_insert_id($connection);
      echo "<h4 class='bg-success'>Articol creat! <a href='../post.php?p_id=$the_post_id'>Uita-te la articol</a> sau <a href='posts.php'>Editeaza alte articole</a></h4>";
  }

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Numele Articolului</label>
         <input type="text" class="form-control" name="title" placeholder="Numele Articolului">
    </div>


     <div class="form-group">
        <select name="post_category_id" id="" class="form-control">
            <option value="Categorie">Categoria Articolului</option>
            <?php
            $query = "SELECT * FROM categories WHERE cat_user_id = {$_SESSION['user_id']}";
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



<!--    <div class="form-group">-->
<!--        <label for="title">Autorul Articolului</label>-->
<!--        <input type="text" class="form-control" name="author">-->
<!--    </div>-->

    <div class="form-group">

        <select name="post_status" id="" class="form-control">
            <option value="draft">Starea Articolului</option>
            <option value="published">Publicat</option>
            <option value="draft">In lucru</option>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Imaginea Articolului</label>
        <input type="file"  name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Taguri</label>
        <input type="text" class="form-control" name="post_tags" placeholder="Taguri">
    </div>

    <div class="form-group">
        <label for="title">
            Conţinutul</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" ></textarea>
    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>



</form>