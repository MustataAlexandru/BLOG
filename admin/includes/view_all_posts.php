<?php
global $connection;

include "delete_modal.php";

if($_SESSION['user_role'] == 'subscriber') {
    redirect('sub_posts.php');
} else if (!isset($_SESSION['user_role'])) {redirect('../index.php');
}

if(isset($_POST['submit'])){

    foreach($_POST['checkBoxArray'] as $postValueId){

      $bulk_options = escape($_POST['bulk_options']);

      switch($bulk_options) {
          case 'published':
              $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id = $postValueId ";
              $update_published_status = mysqli_query($connection,$query);
              if(!$update_published_status)die('QUERY FAILED!'. mysqli_error($connection));
              break;

          case 'draft':
              $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $postValueId ";
              $update_draft_status = mysqli_query($connection, $query);
              if(!$update_draft_status)die('QUERY FAILED!'. mysqli_error($connection));
              break;

          case 'delete':
              $query = "DELETE FROM posts WHERE post_id = $postValueId";
              $update_posts = mysqli_query($connection , $query);
              if(!$update_posts)die('QUERY FAILED!') . mysqli_error($connection);
              break;

          case 'clone':
              $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
              $select_post_query = mysqli_query($connection , $query);
              while ($row = mysqli_fetch_array($select_post_query)) {
                  $post_title = escape($row['post_title']);
                  $post_category_id = escape($row['post_category_id']);
                  $post_date = escape($row['post_date']);
                  $post_author = escape($row['post_author']);
                  $post_user = escape($row['post_user']);
                  $post_status = escape($row['post_status']);
                  $post_image = escape($row['post_image']);
                  $post_tags = escape($row['post_tags']);
                  $post_content = escape($row['post_content']);
              }
             $query ="INSERT INTO posts(post_title, post_category_id, post_date, post_author,post_user, post_status, post_image, post_tags,post_content) ";
              $query .= "VALUES('{$post_title}' , {$post_category_id}, '{$post_date}', '{$post_author}','{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}')";
             $copy_query = mysqli_query($connection, $query);
             if(!$copy_query)die('QUERY FAILED'.mysqli_error($connection));
             break;
      }

    }

}

?>


<form action="" method="post">

<table class="table table-bordered table-hover">


    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Selecteaza Optiuni</option>
            <option value="published">Publica</option>
            <option value="draft">In lucru</option>
            <option value="delete">Sterge</option>
            <option value="clone">Cloneaza</option>
        </select>
    </div>
        <div class="col-xs-4" style="margin-bottom: 20px; margin-left: 10px;">
    <input type="submit" name="submit" class="btn btn-success" value="Aplica" style="margin-right: 15px;">
    <a class="btn btn-primary" href="posts.php?source=add_post">Adauga postare</a>
     </div>



    <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Autor</th>
        <th>Titlu</th>
        <th>Categorie</th>
        <th>Status</th>
        <th>Imagine</th>
        <th>Taguri</th>
        <th>Comentarii</th>
        <th>Data</th>
        <th>Vizualizari</th>
        <th>Vezi Postarea</th>
        <th>Editeaza</th>
        <th>Sterge</th>
    </tr>
    </thead>

    <tbody>

    <?php
    global $connection;
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
        $post_views_count = $row['post_views_count'];
        echo "<tr>";
        ?>


        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>


    <?php
        echo "<td> $post_id</td>";




        echo "<td> $post_user</td>";
        echo "<td> $post_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        $select_categories_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<td> {$cat_title}</td>";
        }
        echo "<td> $post_status</td>";
        echo "<td> <img width= '100px' height='40px' class='img-responsive' src='../images/$post_image' alt='image'/></td>";
        echo "<td> $post_tags</td>";





        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection , $query);


        $row = mysqli_fetch_array($send_comment_query);

        $count_comments = mysqli_num_rows($send_comment_query);

        echo "<td> $count_comments <a href='post_comments.php?id=$post_id'>Vezi</a></td>";




        echo "<td> $post_date</td>";
        echo "<td>$post_views_count</td>";
        echo "<td><a href='../post.php?p_id=$post_id'>Vezi postarea</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Editeaza</a></td>";
        echo "<td><a rel='$post_id' href='#' class='delete_link'>Sterge</a></td>";
        echo "</tr>";
    }



    ?>



    </tbody>
</table>
</form>
<?php

if(isset($_GET['delete'])) {
 if(isset($_SESSION['user_role'])) {
     if($_SESSION['user_role'] == 'admin') {
         $the_post_id = $_GET['delete'];
         $query = "DELETE FROM posts WHERE post_id = $the_post_id";
         $delete_query = mysqli_query($connection, $query);
         $query = "DELETE FROM comments WHERE comment_post_id = $the_post_id";
         $comments_delete_query = mysqli_query($connection, $query);
         header("Location: posts.php");
     }
 }
}

?>



<script>

    $(document).ready(function(){

        $('.delete_link').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('rel');
            var delete_url = "posts.php?delete=" + id +" ";
            $(".modal_delete_link").attr("href", delete_url);
            $('#myModal').modal('show');

        });

    });



</script>

