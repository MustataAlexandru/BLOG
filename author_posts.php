<?php
include 'includes/header.php';
global $connection;
?>


<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">



                <?php

                if(isset($_GET['p_id'])) {

                    $the_post_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];

                }

                ?>



                <?php

                $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ";
                $select_all_posts_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>


                    <!-- First Blog Post -->
                <div style='margin-bottom: 25px;border: 1px solid #f5f5f5;padding: 20px;border-radius: 5px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;'>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        de <a href="?author=<?php echo $post_author?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" >
                    <hr>
                    <p><?php echo $post_content ?></p>
                </div>

                    <?php

                }

                ?>








            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'?>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->


<?php include 'includes/footer.php'?>