<?php

include 'config/db.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM posts_blog WHERE id = '$id' ";

$result = mysqli_query($conn, $sql);

$blog = mysqli_fetch_assoc($result);

mysqli_free_result($result);

mysqli_close($conn);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog </title>

</head>

<body>

    <div class="container">
        <h1><?php echo $blog['title'] ?></h1>
        <p><?php echo $blog["body"] ?> </p>
        <p>Created by <?php echo $blog["author"] ?>. <?php echo $blog["created_at"] ?>
        </p>

        <a href="editpost.php?id=<?php echo $blog["id"] ?>">Edit</a>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" name="delete_id" value="<?php echo $blog["id"] ?>">
            <input type="submit" value="Delete" name="delete">
        </form>
    </div>
</body>

</html>