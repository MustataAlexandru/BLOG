 <!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">Pagina principala</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
<li>
                <div class="btn-group hvr ">

                    <a class="btn dropdown-toggle hvr" style="background-color: transparent; color: #9d9d9d;border: none;" data-toggle="dropdown" href="#"; >
                        Categorii
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">

                        <?php include 'db.php';
                global $connection;
           $query = "SELECT * FROM categories";
           $select_all_categories_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                   $cat_title = $row['cat_title'];
                   $cat_id = $row['cat_id'];
                   $category_class= '';
                   $registration_class =  '';
                   $pageName = basename($_SERVER['PHP_SELF']);
                   $registration = 'registration.php';

                   echo "<li > <a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }
                ?>
                    </ul>
                </div>
    </li>



                <?php

                if(isset($_SESSION['user_role'])) {
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                        echo"<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Editeaza Postare</a></li>";
                    }
                }

                ?>

                <li>
                    <a href='contact.php'>Contact</a>
                </li>
                <li>


                    <?php

                    if(!isset($_SESSION['username'])) {
                        echo "<li '>
                    <a href='registration.php'>Inregistrare</a>
                </li>";
                    }


                    ?>
                    <?php

                    if(isset($_SESSION['user_role'])){
                        $user_role = $_SESSION['user_role'];
                        if($user_role === 'admin') {
                            echo "<a style='position: absolute; top: 40%;' href='admin/index.php'>Admin</a>";
                        }
                    }

                    ?>

                </li>
            <?php


            if(!isset($_SESSION['user_role'])) {
                echo "<li><a href='login.php'>Autentificare</a></li>";
            } else if($_SESSION['user_role'] == 'subscriber') echo "<li><a href='logout.php'>Deconectare</a></li>"

            ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>