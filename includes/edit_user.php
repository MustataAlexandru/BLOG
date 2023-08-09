
<?php


global $connection;
if(isset($_GET['edit_user'])) {

    $user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $get_user_data = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($get_user_data)) {
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $role = $row['user_role'];
        $username = $row['username'];
        $email = $row['user_email'];
        $password = $row['user_password'];
    }
}

if(isset($_POST['edit_user'])) {

    global $connection;


    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username1 = $_POST['username'];

    $user_email = mysqli_real_escape_string($connection, $_POST['user_email'] ) ;
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password'] ) ;
    $options = ['cost' => 12];
    $hashed_password = password_hash($user_password , PASSWORD_BCRYPT, $options);

    if(empty($user_password)){
    $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username1}', user_email = '{$user_email}' WHERE user_id = $user_id";
    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_query);
    header("Location: users.php");
    } else {
        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username1}', user_email = '{$user_email}', user_password = '{$hashed_password}' WHERE user_id = $user_id";
        $edit_user_query = mysqli_query($connection, $query);
        confirmQuery($edit_user_query);
        header("Location: users.php");
    }

}




?>


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
        <select class="form-control" name="user_role" id="">
            <option value="<?php echo $role; ?>"> <?php echo $role; ?> </option>
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
        <input type="password" class="form-control" name="user_password" id="" placeholder="Enter your password" value="">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User" >
    </div>



</form>