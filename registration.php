
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


 <div class="container2" style="margin-top: 7rem">
     <div class="row justify-content-center" style="display: flex; justify-content: center; ">
         <div class="col-sm-8 col-md-6 col-lg-4" style="border: 1px solid #e5e5e5; padding: 15px">
             <div class="text-center">
                 <?php echo $message ?>
                 <h2>Înregistrare</h2>
             </div>
             <div class="card">
                 <div class="card-body">
                     <form action="registration.php" method="post">
                         <div class="form-group">
                             <label for="username" class="sr-only">Nume de utilizator</label>
                             <input type="text" name="username" id="username" class="form-control" placeholder="Nume de utilizator">
                         </div>
                             <div class="form-group">

                                 <label for="firstname" class="sr-only">Prenume</label>
                                 <input type="text" name="user_firstname" id="firstname" class="form-control" placeholder="Prenume">
                             </div>
                             <div class="form-group">

                                 <label for="lastname" class="sr-only">Nume</label>
                                 <input type="text" name="user_lastname" id="lastname" class="form-control" placeholder="Nume">
                             </div>

                         <div class="form-group">
                             <label for="email" class="sr-only">Email</label>
                             <input type="email" name="email" id="email" class="form-control" placeholder="Email (cineva@exemplu.ro)">
                         </div>
                         <div class="form-group">
                             <label for="password" class="sr-only">Parola</label>
                             <input type="password" name="password" id="password" class="form-control" placeholder="Parola">
                         </div>
                         <div class="form-group">
                             <label for="password2" class="sr-only">Reintroduceți parola</label>
                             <input type="password" name="password2" id="password2" class="form-control" placeholder="Reintroduceți parola">
                         </div>
                         <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Înregistrare">
                     </form>
                     <div class="form-group mt-3">
                         <p class="text-center">Ai deja cont? <a href="login.php">Mergi la autentificare</a></p>
                     </div>
                 </div>
             </div> <!-- /.card -->
         </div> <!-- /.col-sm-8 col-md-6 col-lg-4 -->
     </div> <!-- /.row justify-content-center -->
 </div> <!-- /.container -->


 <hr>



<?php include "includes/footer.php";?>
