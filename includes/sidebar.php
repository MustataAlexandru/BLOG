<?php include "functions.php";?>
<div class="col-md-4" ">

<?php

  if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  loginUser($username,$password);
  }
    ?>

            <!--LOGIN-->
    <?php if(!isset($_SESSION['username'])) {
        $unique_id = uniqid();
    echo"   
        <div class='well boxShadow' >
        <h4 class='text-center' > Conecteaza-te</h4 >      
        <form action = 'login.php' method = 'post' >
            <div class='form-group' >
                <input name = 'username' type = 'text' class='form-control' placeholder = 'Enter your username' >
            </div >
            <div class='form-group' >
                <input name = 'password' type = 'password' class='form-control' placeholder = 'Enter your password' >
            </div >
            <style >
            .button {
            width:
            100 %;
        }
            </style >
            <div class='form-group'>
            <a href='forgot.php?forgot=$unique_id'><h4 class='text-center'>Ai uitat parola?</h4></a>
            
</div>
  <div class='form-group'>
            <a href='registration.php'><h4 class='text-center'>Mergi la inregistrare</h4></a>
            
</div>
             <div class='form-group'>
                <button class='btn btn-primary button'  name = 'login' type = 'submit'>Login</button >
             </div>
 
        </form >
    </div >";
} else {
        echo "<div class='well boxShadow' >
        <h4 class='text-center' > Connectat ca: {$_SESSION['username']}</h4 >      
        <form action = 'logout.php' method = 'post' >
             <div class='form-group'>
                <button class='btn btn-primary button' name = 'logout' type = 'submit'>Deconectare</button >
             </div>

        </form >
    </div >";
    }
?>





<?php
global $connection;
$query = "SELECT * FROM categories LIMIT 12";
$select_categories_sidebar = mysqli_query($connection , $query)


?>



    <!-- Blog Categories Well -->
    <div class="well boxShadow">
        <h4 class="text-center">Categorii</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                    while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }

                    ?>


                </ul>
            </div>
            <!-- /.col-lg-6 -->



            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <?php include "widget.php"?>
