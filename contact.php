
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<?php
global $connection;

if(isset($_POST['submit'])) {
    $to = 'mustata.alexandru.cristian@gmail.com';
    $header   =  $_POST['email'];
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: Your name <{$header}>" . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $subject = wordwrap($_POST['subject'], 70);
    $body    = mysqli_real_escape_string($connection, $_POST['body']) ;
// send email
    if(mail($to,$subject,$body,$headers)) echo "Email sent succesfully!";
    else echo "There was an error!";
}

?>


<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row justify-content-center" style="display: flex; justify-content: center; ">
                <div class="col-sm-8 col-md-6" style="border:1px solid #e5e5e5; padding: 20px;box-shadow: 8px 7px 4px 4px rgba(0,0,0,0.1);">
                    <div class="form-wrap">
                        <h2 class="text-center">Trimite un email</h2>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="cineva@email.com">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" id="email" class="form-control" placeholder="Subiect email">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="body" id="username" style="height: 20rem" class="form-control" placeholder="Mesaj"></textarea>
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Trimite email">
                        </form>
                    </div> <!-- /.form-wrap -->
                </div> <!-- /.col-sm-8 col-md-6 -->
            </div> <!-- /.row justify-content-center -->
        </div> <!-- /.container -->
    </section>



    <hr>



    <?php include "includes/footer.php";?>
