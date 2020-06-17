<?php
include 'config/db.php';
session_start();

$err = '';
$err_pass = '';
$err_user = '';

if (isset($_POST['submit'])) {

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $err = " Please Fill all fields";
    } else {
        $uname = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM user_log WHERE username='$uname' or email='$uname'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            if ($hash == false) {
                $err_pass = "Invalid Password";
            } elseif ($pass == true) {
                $_SESSION['U_D'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];

                // header("location: addblog.php");
                echo 'Login succsful';
                // exit();
            }
        } else {
            $err_user = "Invalid user";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>

    </style>
</head>

<body>
    <div class="body-login">
        <a href="index.php" class="back"> ← </a>

        <div class="login">
            <h3>LOGIN TO Post.IT</h3>

            <form action="login.php" method="POST" class="form-login">

                <div class="error">
                    <?= $err ?>
                </div>

                <div>

                    <input type="text" name="username" id="email" placeholder="Enter Username or Email" class="form-control">

                </div>

                <div class="error">
                    <?= $err_user ?>
                </div>

                <div>

                    <input type="password" name="password" placeholder="**********" class="form-control">

                </div>

                <div class="error">
                    <?= $err_pass ?>
                </div>

                <div class="btn">
                    <input type="submit" value="login" name="submit">
                </div>

                <div>
                    <p>Don't have an account? <a href="signup.php">Create one</a> </p>
                </div>
            </form>
        </div>

    </div>

</body>





</html>