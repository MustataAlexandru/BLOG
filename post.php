<?php global $connection;
include 'includes/header.php' ?>


<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">



                <?php

                if(isset($_GET['p_id'])) {

                    $the_post_id = $_GET['p_id'];
                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $send_query = mysqli_query($connection, $query);
                if(!$send_query)die('QUERY FAILED' . mysqli_error($connection));


                ?>



                <?php

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_all_posts_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>
                <?php

//                    $query = "SELECT * from posts WHERE post_user = '{$post_author}'";
//                    $select_author_posts = mysqli_query($connection, $query);


                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        de <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=#"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" >
                    <hr>
                    <p><?php echo $post_content ?></p>


                    <?php

                }

                } else {
                    header('Location: index.php');
                }


                ?>






                <?php

                if(isset($_POST['create_comment'])) {
                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                        $comment_content = mysqli_real_escape_string($connection ,$_POST['comment_content']);
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connection, $query);

                        if (!$create_comment_query) {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }

//                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id ";
//                        $update_comment_count_query = mysqli_query($connection , $query);
                    } else {
                        echo "<script>alert('Fields cannot be empty!')</script>";
                    }


                }



                ?>


                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Lasa un comentariu:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label for="Author">Autor</label>
                            <input type="text" class="form-control" name="comment_author" placeholder="author">

                        </div>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email" placeholder="email">

                        </div>

                        <div class="form-group">
                            <label for="comment">Comentariul tau</label>
                            <textarea name="comment_content" class="form-control" rows="3" placeholder="Your comment"></textarea>

                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Trimite</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                <?php

                $query = "SELECT * FROM comments WHERE comment_post_id ={$the_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query) {
                    die('QUERY FAILED' .mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_author'];
                    $comment_author = $row['comment_content'];
              ?>


                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="https://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">    <?php echo $comment_content; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>

                        </div>
                        <?php echo $comment_author; ?>

                    </div>

             <?php } ?>




                <!-- Comment -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'?>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->


<?php include 'includes/footer.php'?>