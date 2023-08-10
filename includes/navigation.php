 <!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top navShadow" role="navigation">

    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="position: sticky" href="index.php" >
                <img  src="../images/logo/logo.png" alt ='logo' class="logo"/>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Categorii <b class="caret"></b></a>
                        <ul class="dropdown-menu">



                        <?php
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


    </li>





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
                            echo "<li><a href='admin/index.php'>Admin</a></li>";
                        } else echo "<li><a href='admin/dashboard.php'>Panou de control</a></li>";
                    }

                    ?>

                </li>
            <?php
            if(!isset($_SESSION['user_role'])) {
                echo "<li><a href='login.php'>Autentificare</a></li>";
            }
            ?>


                            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] =='admin'):?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><ion-icon class="ion" name="person-circle-outline"></ion-icon></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profil</a>
                                        </li>


                                        <li class="divider"></li>
                                        <li>
                                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] =='subscriber'):?>
                                <li class="dropdown ion">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><ion-icon  name="person-circle-outline"></ion-icon></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="admin/sub_profile.php"><i class="fa fa-fw fa-user"></i> Profil</a>
                                        </li>


                                        <li class="divider"></li>
                                        <li>
                                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>