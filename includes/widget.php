<div class="well">
    <h4 class="text-center">Anunturi</h4>
    <?php
    global $connection;

    $query = "SELECT * from posts WHERE post_status = 'draft'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $post_user = $row['post_user'];
           echo "<p>$post_user lucreaza la o postare. </p>";
        }
    } else {
        echo "<p>Informatii despre postari noi vor aparea aici.</p>";
    }



    ?>
</div>