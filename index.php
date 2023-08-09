<?php
include 'includes/header.php' ?>


<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 5rem">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                $per_page = 10;

                if(isset($_GET['page'])){



                    $page = $_GET['page'];

                }
                else $page = "";

                if($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }


                $post_query_count = "SELECT * FROM posts ";
                $find_count = mysqli_query($connection, $post_query_count);
                $posts_count = mysqli_num_rows($find_count);

                $count = ceil($posts_count / $per_page);

                 $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1,$per_page ";
                 $select_all_posts_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,100);
                    $post_status = $row['post_status'];
                    if($post_status !== 'published') {

                        echo "<div class='form-group' style='border: 1px solid #f5f5f5;padding: 20px;border-radius: 10px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;background-color: #f5f5f5;'><h4>  {$post_author} lucreaza la o postare '${post_title}'. </h4></div>";

                    } else {
                    ?>
<!--                    <h1 class="page-header">-->
<!--                        Articles-->
<!--                        <small>about</small>-->
<!--                    </h1>-->

                    <!-- First Blog Post -->
                <div style='margin-bottom: 25px;border: 1px solid #f5f5f5;padding: 20px;border-radius: 5px;box-shadow: -6px 7px 8px -4px rgba(0,0,0,0.1);background-color:#f5f5f5;'>
                    <h2 class="text-center">
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        de <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                <a href = "post.php?p_id=<?php echo $post_id?>">
                    <img class="img-responsive img" src="images/<?php echo $post_image ?>" alt="image" >
                </a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" style="border:none background-color: grey;" href="post.php?p_id=<?php echo $post_id;?>">Citeste mai mult<span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                    <?php
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
       <ul class="pager">
           <?php

           for($i = 1; $i <=$count; $i++) {

               if($i == $page) {
                   echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
               }

             else  echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
           }

           ?>


       </ul>
        <!-- Footer -->


<?php include 'includes/footer.php'?>