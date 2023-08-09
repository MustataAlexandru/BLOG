<?php global $connection;
include 'includes/header.php' ?>


<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 5rem">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                global $connection;
                if(isset($_POST['submit'])) {

                    $search = $_POST['search'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%' OR post_user LIKE '%$search%' ";
                    $search_query = mysqli_query($connection, $query);

                    if(!$search_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);
                    if($count==0) {
                        echo "<h1>No articles found. Please try something else!</h1>";
                    }

                    else{




                while($row = mysqli_fetch_assoc($search_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $p_id = $row['post_id'];

                    ?>


                    <!-- First Blog Post -->
                <div style='margin-bottom: 25px;border: 1px solid #f5f5f5;padding: 20px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;'>
                    <h2>
                        <a href="post.php?p_id=<?php echo $p_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        de <a href="author_posts.php?author=<?php echo $post_author?>&p_id=<?php echo $p_id;?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $p_id; ?>"><img class="img-responsive"  src="images/<?php echo $post_image ?>" alt="post image"></a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $p_id; ?>">Citeste <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                    <?php

                }













                }
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