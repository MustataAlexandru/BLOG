<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; ?>

<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php  include "Classes/config.php"; ?>
<?php  include "includes/navigation.php";
require './vendor/autoload.php';
//require './Classes/config.php';

global $connection;
if(!isset($_GET['forgot'])) {
    redirect('index.php');
}

if(ifItIsMethod('post')) {
    if(isset($_POST['email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        $query = "SELECT * FROM users where user_email = '{$email}' AND username = '{$username}'";
        $submit_query = mysqli_query($connection, $query);
        if($result = mysqli_num_rows($submit_query) !== 0) {
            if($stmt = mysqli_prepare($connection , "UPDATE users SET token='{$token}' WHERE user_email = ?")){
            mysqli_stmt_bind_param($stmt,'s', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

                         ////// PHPMAILER //////
                $mail = new PHPMailer(true);
//                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Mailer ='smtp';
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Host       = 'smtp.gmail.com';
                $mail->Port       = 587;
                $mail->Username   = 'mustata.alexandru.cristian@gmail.com';
                $mail->Password   = 'qkpokdmmfilwgyta';

                $mail->isHTML(true);
                try {
                    $mail->setFrom('resetpassword@support.ro', 'Mustata Alexandru');
                } catch (\PHPMailer\PHPMailer\Exception $e) { echo $e;
                }
                try {
                    $mail->addAddress($email, $username);
                } catch (\PHPMailer\PHPMailer\Exception $e) { echo $e;
                }
                $mail->Subject = 'Reset password';
                $mail->Body = '<p>Please click to reset your password
<a href="https://studentii.lol/reset.php?email='.$email.'&token='.$token.'">https://studentii.lol/reset.php?email='.$email.'&token='.$token."  ". '</a>
</p>';
                   if($mail->send()) {

                       $emailSent = true;

                   }
            }

        }
        else echo '<h1 class="text-center" style="color: red;">Nu s-a gasit un cont cu email-ul si username-ul introduse.</h1>';
    }
}


?>


<!-- Page Content -->
<div class="container" style="margin-top: 10rem;">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php  if(!isset($emailSent)):  ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Ai uitat parola?</h2>
                                <p>Poti reseta parola aici!</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="username" placeholder="username" class="form-control"  type="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="adresa de email" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reseteaza Parola" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else: ?>
<h1>Please check your email!</h1>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

