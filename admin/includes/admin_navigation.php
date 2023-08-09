<!-- Navigation -->

<?php
global $connection;

$session = session_id();
$time = time();
$time_out_in_seconds = 20;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '{$session}'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

if($count == NULL) {
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES( '$session', '$time')");
} else {
    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '{$session}'");
}
$users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out'");
$count_user = mysqli_num_rows($users_online_query);
?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


    <!-- Brand and toggle get grouped for better mobile display -->



    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class='navbar-brand' href='../index.php'>Pagina principala</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav nav-flex">




        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="sub_profile.php"><i class="fa fa-fw fa-user"></i> Profil</a>
                </li>


                <li class="divider"></li>
                <li>
                    <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>




    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            <li>
                <?php if(($_SESSION['user_role']) === 'admin') echo "<a href='index.php'><i class='fa fa-fw fa-dashboard'></i> Panou de control </a>";
                else echo "<a href='dashboard.php'><i class='fa fa-fw fa-dashboard'></i> Statistici </a>";
                ?>


            </li>



            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Articole <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <?php if($_SESSION['user_role'] === 'admin')echo "<a href='./posts.php'>Vezi Articolele</a>";
                        else echo "<a href='./sub_posts.php'>Vezi Articolele</a>";
                        ?>

                    </li>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <li>
                        <a href="posts.php?source=add_post">Adauga Articole</a>
                    </li>
                    <?php elseif($_SESSION['user_role'] === 'subscriber'): ?>
                    <li>
                        <a href="sub_posts.php?source=add_post">Adauga Articole</a>
                    </li>
                    <?php endif ?>
                </ul>
            </li>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
            <li>
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i>Categorii</a>
            </li>
            <?php elseif ($_SESSION['user_role'] ==='subscriber'): ?>
            <li>
                <a href="sub_categories.php"><i class="fa fa-fw fa-wrench"></i>Categorii</a>
            </li>
            <?php endif; ?>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
            <li class="">
                <a href="comments.php"><i class="fa fa-fw fa-file"></i>Comentarii</a>
            </li>
            <?php elseif ($_SESSION['user_role'] === 'subscriber'): ?>
            <li class="">
                <a href="sub_comments.php"><i class="fa fa-fw fa-file"></i>Comentarii</a>
            </li>
            <?php endif; ?>
            <li>
                <?php if($_SESSION['user_role'] ==='admin'): ?>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Utilizatori<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="users.php">Vezi toti utilizatorii</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Adauga utilizator</a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if($_SESSION['user_role'] ==='admin'): ?>
            <li class="">
                <a href="profile.php"><i class="fa fa-fw fa-file"></i> Profil </a>
            </li>
            <?php elseif($_SESSION['user_role'] ==='subscriber'): ?>
                <li class="">
                    <a href="sub_profile.php"><i class="fa fa-fw fa-file"></i> Profil </a>
                </li>
            <?php endif;?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->




</nav>