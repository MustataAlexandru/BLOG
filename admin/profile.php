
<?php include 'includes/admin_header.php' ?>


   <?php
global $connection;
   if(isset($_SESSION['username'])) {
       global $connection;
       $username = $_SESSION['username'];
       $query = "SELECT * FROM users WHERE username = '{$username}' ";
       $submit_query = mysqli_query($connection, $query);
       if(!$submit_query) {
           die('QUERY FAILED' . mysqli_error($connection));
       }
       while ($row= mysqli_fetch_assoc($submit_query)) {
           $firstname = $row['user_firstname'];
           $lastname = $row['user_lastname'];
           $role = $row['user_role'];
           $email = $row['user_email'];
           $password = $row['user_password'];
       }

   }

   if(isset($_POST['update_user'])) {
       $username = $_SESSION['username'];
       $updated_firstname = $_POST['user_firstname'];
       $updated_lastname = $_POST['user_lastname'];
       $updated_role = $_POST['user_role'];
       $updated_username = $_POST['username'];
       $updated_email = $_POST['user_email'];
       $updated_password = $_POST['user_password'];
    $query = " UPDATE users SET 
                  user_firstname = '{$updated_firstname}',
                  user_lastname = '{$updated_lastname}',
                  user_role = '{$updated_role}',
                  username = '{$updated_username}',
                  user_email = '{$updated_email}',
                  user_password = '{$updated_password}'
              WHERE username = '{$username}' ";
    $update_query = mysqli_query($connection, $query);
    if (!$update_query) die('QUERY FAILED' . mysqli_error($connection));
    header("Location: index.php");
   }


   ?>

<div id="wrapper">




    <?php include 'includes/admin_navigation.php' ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">
                        Pagina administrare
                        <small> Autor </small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data" class="">

                        <div class="form-group">
                            <label for="firstname">Nume</label>
                            <input type="text" class="form-control" name="user_firstname" placeholder="Enter your firstname" value="<?php echo $firstname;?>">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Prenume</label>
                            <input type="text" class="form-control" name="user_lastname" placeholder="Enter your lastname" value="<?php echo $lastname;?>">
                        </div>

                        <div class="form-group">
                            <select class="form-group" name="user_role" id="">
                                <option value=""> <?php echo $role; ?> </option>
                                <?php

                                if($role == 'admin') {

                                    echo "<option value='subscriber'>Subscriber</option>";

                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }


                                ?>



                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter your username" value="<?php echo $username;?>">
                        </div>

                        <!--    <div class="form-group">-->
                        <!--        <label for="title">Post Image</label>-->
                        <!--        <input type="file"  name="image">-->
                        <!--    </div>-->

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="user_email" placeholder="Enter your email" value="<?php echo $email;?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="user_password" id="" placeholder="Enter your password" value="<?php echo $password;?>">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="Actualizeaza Datele" >
                        </div>



                    </form>




                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'?>
