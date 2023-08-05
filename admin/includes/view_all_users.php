<?php include "delete_modal.php";

?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Prenume</th>
        <th>Nume</th>
        <th>Email</th>
        <th>Rol</th>
    </tr>
    </thead>

    <tbody>

    <?php
    global $connection;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection , $query);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];


        echo "<tr>";

        echo "<td> $user_id </td>";
        echo "<td> $username </td>";
        echo "<td> $user_firstname </td>";
        echo "<td> $user_lastname </td>";
        echo "<td> $user_email </td>";
        echo "<td> $user_role </td>";
        echo "<td><a href='users.php?change_to_admin=$user_id'>Fa-l Admin</a></td>";
        echo "<td><a href='users.php?change_to_sub=$user_id'>Fa-l Subscriber</a></td>";

        echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Editeaza</a></td>";
        echo "<td><a rel='$user_id' href='' class='delete_link'>Sterge</a></td>";

//        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
//        $select_post_id_query = mysqli_query($connection, $query);
//        while($row = mysqli_fetch_assoc($select_post_id_query)) {
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//            echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
//        }







        echo "</tr>";
    }



    ?>



    </tbody>
</table>

<?php

if(isset($_GET['change_to_admin'])) {

    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $toAdmin_query = mysqli_query($connection, $query);
    if(!$toAdmin_query) {
        die('QUERY FAILED'. mysqli_error($connection));
    }
    header("Location: users.php");
}



if(isset($_GET['change_to_sub'])) {

    $the_user_id = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
    $toSub_query = mysqli_query($connection, $query);
    if(!$toSub_query) {
        die('QUERY FAILED'. mysqli_error($connection));
    }
    header("Location: users.php");
}


if(isset($_GET['delete'])) {

    if(isset($_SESSION['user_role'])){
         if($_SESSION['user_role'] == 'admin') {
             $the_user_id = mysqli_real_escape_string($connection ,$_GET['delete']);
             $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
             $delete_query = mysqli_query($connection, $query);
             if (!$delete_query) die('QUERY FAILED' . mysqli_error($connection));
             header("Location: users.php");
         }
    }
}

?>
<script>
$(document).ready(function(){

$('.delete_link').on('click', function(e) {
e.preventDefault();
var id = $(this).attr('rel');
var delete_url = "users.php?delete="+ id +" ";
$(".modal_delete_link").attr("href", delete_url);
$('#myModal').modal('show');

});

});
</script>