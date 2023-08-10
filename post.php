<?php global $connection;
include 'includes/header.php';

?>
<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container " style="margin-top: 5rem">

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
            $post_user_id = $row['post_user_id'];
            ?>
            <?php

            //                    $query = "SELECT * from posts WHERE post_user = '{$post_author}'";
            //                    $select_author_posts = mysqli_query($connection, $query);


            ?>

                <!-- First Blog Post -->
                <div style='margin-bottom: 25px;border: 1px solid #f5f5f5;padding: 20px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;'>
                    <h2 class="text-center">
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead ">
                        de <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=#"><?php echo $post_author ?></a>
                    </p>
                    <p class="lead">    <?php

                        if(($_SESSION['user_id']) == $post_user_id) {
                            if(isset($_GET['p_id'])){
                                $the_post_id = $_GET['p_id'];
                                echo"<a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Editeaza Postare</a>";
                            }
                        }

                        ?></p>
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

                        $query = "SELECT * FROM users INNER JOIN comments WHERE comments.comment_user_id = users.user_id" ;
                        $submit_query = mysqli_query($connection , $query);
                        if(!$submit_query) die('QUERY FAILED'. mysqli_error($connection));
                        if ($row = mysqli_fetch_assoc($submit_query)) {
                            $user_image = $row['user_image'];
                        }

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_SESSION['username'];
                        $comment_email = $_SESSION['user_email'];
                        $comment_content = $_POST['comment_content'];

                        $comment_user_id = $_SESSION['user_id'];
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                            $comment_content = mysqli_real_escape_string($connection ,$_POST['comment_content']);
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date ,comment_user_id)";
                            $query .= "VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approved', now(), $comment_user_id)";

                            $create_comment_query = mysqli_query($connection, $query);

                            if (!$create_comment_query) {
                                die('QUERY FAILED' . mysqli_error($connection));
                            }

//                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id ";
//                        $update_comment_count_query = mysqli_query($connection , $query);
                        }


                    }



                    ?>


                    <!-- Blog Comments -->

                    <!-- Comments Form -->
                    <?php if(isset($_SESSION['user_role'])): ?>
                        <div class="well">
                            <h4 class="text-center">Lasa un comentariu:</h4>
                            <form action="" method="post" role="form">



                                <div class="form-group">
                                    <label for="comment">Comentariul tau</label>
                                    <textarea name="comment_content" class="form-control" rows="3" placeholder="Your comment"></textarea>

                                </div>
                                <button type="submit" name="create_comment" class="btn btn-primary">Trimite</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="well">
                            <h4 class="text-center">Trebuie sa te <a href="login.php">autentifici</a> pentru a interactiona</h4>
                        </div>
                    <?php endif ?>
                </div>
                <hr>

                <!-- Posted Comments -->
                <?php


                ?>

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
                    $comment_user_id = $row['comment_user_id'];
                    $user_image_query = "SELECT user_image FROM users WHERE user_id = $comment_user_id";
                    $user_image_result = mysqli_query($connection, $user_image_query);
                    if ($user_image_row = mysqli_fetch_assoc($user_image_result)) {
                        $user_image = $user_image_row['user_image'];}
                    ?>




                    <div class="commentContainer">
                        <div class="flex1">
                            <a class="" href="#">
                                <img class="img-responsive profileImg" src="images/<?php echo $user_image ?>" alt="profile img">
                            </a>
                        </div>
                        <div class="" style="width: 80%; margin-left: 3rem ;">
                            <h4 class="" style="border-bottom:1px solid #e5e5e5">    <?php echo $comment_content; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_author; ?>
                        </div>


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