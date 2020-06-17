<?php

include 'config/db.php';

$sql = "SELECT * FROM posts_blog ORDER BY created_at DESC";

//query to get data
$result = mysqli_query($conn, $sql);

//fetch all
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

//close connection to db
mysqli_close($conn);

// print_r($blogs);


?>

<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" type="text/css" href="templates/style.css" /> -->
<?php include 'templates/header.php' ?>

<div class="blog-home">
    <div class="title-blogs">
        <h4>Latest Post</h4>
    </div>
    <div class="row">

        <div class="col-md-8">
            <!-- change to card -->
            <?php foreach ($blogs as $blog) : ?>
                <div class="container">

                    <div class="card " style="">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($blog['title']) ?></h3>

                            <p class="card-text" style="font-size: 14px;"><?php echo htmlspecialchars(substr($blog['body'], 0, 200)) ?>... </p>

                            <small style="font-style:italic; font-size: 12px;">Created By <?php echo htmlspecialchars($blog['author']) ?> </small>
                            <p style="font-size: 12px;">Posted on <?php echo $blog['created_at'] ?></p>
                            <a href="blog.php?id=<?php echo $blog['id'] ?>">Continue Readng...</a>
                        </div>
                    </div>


                </div>
            <?php endforeach; ?>

        </div>




        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-3">
            But I must explain to you how all this mistaken idea rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, w
        </div>
    </div>
</div>



<?php include 'templates/footer.php' ?>

</html>