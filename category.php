<?php global $connection;
include 'includes/header.php' ?>


<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 5rem">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="well boxShadow" >
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                        </div>
                    </form>
                </div>
                <?php

                if(isset($_GET['category'])) {

                  $post_category_id = $_GET['category'];


                }

                $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'";
                $select_all_posts_query = mysqli_query($connection , $query);

                if($select_all_posts_query->num_rows > 0){
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0 ,100);
                    $post_status = $row['post_status'];

                    ?>

                        <?php
                   $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                   $select_category_query = mysqli_query($connection, $query);
                   while($row = mysqli_fetch_assoc($select_category_query)) {
                       $post_category = $row['cat_title'];
                   }

                    ?>
 <?php

                    if($post_status == 'published') {

                    ?>
                <div style='margin-bottom: 25px;border: 1px solid #f5f5f5;padding: 20px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;'>
                    <h1 class="page-header">
                        <?php echo $post_title;?>
                        <small><?php echo $post_author?></small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        de <a href="admin/index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <a href = "post.php?p_id=<?php echo $post_id?>">
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" >
                    </a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Citeste <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                    <?php }

                }
                }
                else echo "<h3> Nu sunt postari pentru categoria aleasa inca!</h3>";
                ?>






            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->


<?php include 'includes/footer.php' ?>