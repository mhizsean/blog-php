<?php

include 'config/db.php';

if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $body = mysqli_real_escape_string($conn, $_POST["body"]);

    $sql = "INSERT INTO posts_blog (title, author, body) VALUES ('$title', '$author', '$body')";

    if (mysqli_query($conn, $sql)) {
        header('location:' . ROOT_URL);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog </title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="style.css" />

    <style>
        form {
            width: 50%;
            margin: 100px auto;
            display: flex;
            flex-direction: column;
        }

        form input {
            height: 40px;
            margin: 15px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
        }


        textarea {
            height: 100px;
            margin: 15px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
        }

        input[type="submit"] {
            background: green;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  bg-light z-depth-0">
        <div class="container">
            <a class="navbar-brand" href="index.php">Post.IT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="addblog.php">Log out <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li class="nav-item ">
                    <a class="nav-link" href="index.php">Updated List<span class="sr-only">(current)</span></a>
                </li> -->

                    <!-- <li>HI, <?php echo htmlspecialchars($name); ?>!</li> -->
                </ul>

            </div>
        </div>
    </nav>

    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
            <label>Title</label>
            <input type="text" name="title">

            <label>Author</label>
            <input type="text" name="author" ">

            <label>Body</label>
            <textarea name=" body" id="" cols="" rows=""></textarea>

            <input type="submit" value="Post.IT" name="submit">

        </form>
    </div>

</body>

</html>