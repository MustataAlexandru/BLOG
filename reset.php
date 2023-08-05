
<?php  include "includes/header.php"; ?>
<?php include "includes/functions.php" ?>
<?php  include "includes/navigation.php"; ?>
<?php
global $connection;
$verified = false;
  if(!isset($_GET['email']) && !isset($_GET['token'])) {
      redirect('index.php');
  }


if($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token = ?")) {
    $token = $_GET['token'];

    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username,$email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if($_GET['token'] !== $token || $_GET['email'] !== $email) {
      redirect('index.php');
    }
    if(isset($_POST['password']) && isset($_POST['password2'])) {

       if($_POST['password'] === $_POST['password2'])
         {
             $password = $_POST['password'];
             $password2 = $_POST['password2'];
            $options = ['cost' => 12,];
            $encrypted_password = password_hash($password , PASSWORD_BCRYPT,$options);
            if($stmt = mysqli_prepare($connection, "UPDATE users SET  user_password='{$encrypted_password}' WHERE user_email = ?")){
                mysqli_stmt_bind_param($connection,'s' ,$_GET['email']);
                mysqli_stmt_execute($stmt);
                if(mysqli_stmt_affected_rows($stmt) >= 1) {
                    redirect('CMS_TEMPLATE/login.php');
                }
                mysqli_stmt_close($stmt);
                $verified = true;
            }
//            echo "<h3 class='text-center' style='color: lawngreen; margin-left: 4rem'>Parola schimbata</h3>";
        }
//           else echo "<h3 class='text-center' style='color: red; margin-left: 4rem'>Cele doua parole nu corespund</h3>";


    }



}

?>


<!-- Page Content -->
<div class="container">



    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reseteaza-ti parola!</h2>

                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Introduceti noua parola" class="form-control"  type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="password" name="password2" placeholder="Reintruduce-ti parola" class="form-control"  type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>


                                </form>

                            </div><!-- Body-->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

