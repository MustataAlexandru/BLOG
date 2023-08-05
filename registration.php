
 <?php  include "includes/header.php"; ?>
<?php include 'admin/functions.php' ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php
global $connection;

 if(isset($_POST['submit'])) {

      $username = mysqli_real_escape_string($connection, $_POST['username']) ;
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      $firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
      $lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
      $password2 = mysqli_real_escape_string($connection, $_POST['password2']);
      $options = [
              'cost' => 12,
      ];


      if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !username_exists($username) && !email_exists($email)){
          if(strlen($password) > 7 && $password === $password2){
             $password = password_hash($password , PASSWORD_BCRYPT, $options);


             $query ="INSERT INTO users(username, user_email, user_password, user_role , user_firstname, user_lastname) VALUES ('{$username}', '{$email}', '{$password}', 'subscriber', '{$firstname}', '{$lastname}')";
             $register_query = mysqli_query($connection, $query);
             if(!$register_query)die('QUERY FAILED' . mysqli_error($connection));
        $message = "<h2 class='text-center' style='color:greenyellow;'>Inregistrare completa!</h2>";} else $message ='<h3 class="text-center" style="color: red;">Parola prea scurta!</h3>';
//    header("Location: index.php");
      } else if (username_exists($username)){
          $message = '<h2 class="text-center" style="color:red;">Username deja folosit!</h2>';
      } else if(email_exists($email)){
          $message = '<h2 class="text-center" style="color:red;">Email deja folosit!</h2>';
      }

 } else if (empty($username) || empty($password) || empty($firstname) || empty($lastname)){
     $message = '<h3 class="text-center" style="color:red;">Toate campurile trebuie completate!</h3>';
 }

 ?>


    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row" >
            <div class="col-xs-6 col-xs-offset-3" style="border: 1px solid #e3e3e3; padding: 10rem; border-radius: 10px;">
                <div class="form-wrap">
                <h1 class="text-center">Inregresitrare</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message;?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Nume de utilizator">
                        </div>
                         <div class="form-group">
                             <div class="form-group">
                                 <label for="firstname" class="sr-only">username</label>
                                 <input type="text" name="user_firstname" id="username" class="form-control" placeholder="Prenume">
                             </div>
                             <div class="form-group">
                                 <label for="lastname" class="sr-only">username</label>
                                 <input type="text" name="user_lastname" id="username" class="form-control" placeholder="Nume">
                             </div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email(cineva@exemplu.ro)">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Parola">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password2" id="key" class="form-control" placeholder="Reintroduceti parola">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Inregistrare">
                    </form>

                    <div class="form-group">
                        <p class="text-center" style="margin-top: 2rem">Ai deja cont? <a href="login.php">Mergi la autentificare</a></p>
                    </div>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
