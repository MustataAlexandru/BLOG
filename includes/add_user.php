
<?php

if(isset($_POST['create_user'])) {

    global $connection;


    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email'] ) ;
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password'] ) ;
    $options = ['cost' => 12,];
    $password = password_hash($user_password,PASSWORD_BCRYPT, $options);

   $query = "INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role) VALUES ('{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_email}', '{$password}', '{$user_role}') ";
   $create_user_query = mysqli_query($connection, $query);
   confirmQuery($create_user_query);

   echo "User created succesfully!" . " " . "<a href='users.php'>View Users</a> ";

}

?>


<form action="" method="post" enctype="multipart/form-data" class="">

    <div class="form-group">
        <label for="firstname">Nume</label>
        <input type="text" class="form-control" name="user_firstname" placeholder="Nume">
    </div>

    <div class="form-group">
        <label for="lastname">Prenume</label>
        <input type="text" class="form-control" name="user_lastname" placeholder="Prenume">
    </div>

    <div class="form-group">
        <select class="form-group" name="user_role" id="">
            <option value="subscriber">Selecteaza Optiunea</option>
           <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>

<!--    <div class="form-group">-->
<!--        <label for="title">Post Image</label>-->
<!--        <input type="file"  name="image">-->
<!--    </div>-->

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email" placeholder="Email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password" id="" placeholder="Password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Adauga User">
    </div>



</form>