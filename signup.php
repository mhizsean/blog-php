<?php
include 'config/db.php';

$name = $email = $username = $password = $password = '';

//$errors = array('email' => '', 'product' => '', 'ingredients' => '');
$empty = array('name' => '', 'email' => '', 'username' => '', 'password' => '');
$error = array('name' => '', 'email' => '', 'username' => '', 'password' => '');

$empty_all = '';

if (isset($_POST['submit'])) {

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['conpassword'])) {

        $empty_all = "Please fill all fields";
    } else {

        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $empty['email'] = "Email must be valid";
        } else {
            $email = $_POST['email'];

            $sql = "SELECT * FROM user_log WHERE email = '$email'";

            $result = mysqli_query($conn, $sql);

            $num = mysqli_num_rows($result);

            if ($num == 1) {

                $error['email'] = "Email already exist";
            } else {

                $uname = $_POST['username'];

                if (!preg_match('/^[a-zA-Z0-9\s]+$/', $uname)) {

                    $empty['username'] = 'Username can not contian symbols';
                } else {
                    $uname = $_POST['username'];

                    $sql = "SELECT * FROM user_log WHERE username = '$uname'";

                    $result = mysqli_query($conn, $sql);

                    $num = mysqli_num_rows($result);

                    if ($num == 1) {

                        $error['username'] = "Username already taken";
                    } else {

                        $pass = $_POST['password'];

                        $conpass = $_POST['conpassword'];

                        if ($pass != $conpass) {

                            $error['password'] = 'password does not match';
                        } else {

                            $name = mysqli_escape_string($conn, $_POST['name']);
                            $email = mysqli_escape_string($conn, $_POST['email']);
                            $username = mysqli_escape_string($conn, $_POST['username']);
                            $password = mysqli_escape_string($conn, $_POST['password']);

                            $pass = password_hash($password, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO user_log (name, email, username, password) VALUES ('$name', '$email', '$username', '$pass') ";
                            $result = mysqli_query($conn, $sql);

                            header('location: addblog.php ');
                            exit();
                        }
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="templates/style.css" />
    <style>
        body {
            background-color: #302626;

        }

        .back {
            color: #fff;
            width: 100px;
            margin: 20px;
            text-decoration: none;
            font-size: 25px;
            transition: all linear 0.3s;
        }

        .back span {
            font-size: 15px;
        }

        .back:hover {
            color: grey;
            font-size: 30px;
            text-decoration: none;
        }

        .login {
            width: 460px;
            /* height: 300px; */
            margin: 80px auto;
            padding: 20px;
            background-color: #efe;
        }

        .error {
            text-align: center;
            color: red;
            font-size: 15px;
        }

        .login h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 10px;
            border: none;
            border-bottom: 1px solid grey;
            border-radius: 0;
            background-color: transparent;
            padding: 10px;
        }

        .form-control:focus {
            background-color: transparent;
            box-shadow: inset 0 -1px 0 #ddd;
        }


        .btn input {
            margin-left: 130px;
            width: 150px;
            font-size: 20px;
            text-transform: uppercase;
        }
    </style>
</head>

<a href="index.php" class="back"> ← <span> Back Home </span></a>
<div class="login">
    <h3>Sign up to Post.It</h3>
    <form action="signup.php" method="POST">


        <div>

            <input type="text" name="name" class="form-control shadow-none" placeholder="Enter Full Name" autocomplete="off">

        </div>


        <div>

            <input type="email" name="email" class="form-control shadow-none" placeholder="Enter Email" autocomplete="off">

        </div>

        <div class="error">

            <?= $error['email'] ?>
            <?= $empty['email'] ?>

        </div>

        <div>

            <input type="text" name="username" class="form-control shadow-none" placeholder="Choose Username " autocomplete="off">

        </div>

        <div class="error">

            <?= $error['username'] ?>
            <?= $empty['username'] ?>

        </div>

        <div>

            <input type="password" name="password" class="form-control shadow-none" placeholder="***************">

        </div>


        <div class="error">

            <?= $error['password'] ?>

        </div>

        <div>

            <input type="password" name="conpassword" class="form-control shadow-none" placeholder="***************">

        </div>



        <!-- <div class="error">
            <?= $empty_all ?>
        </div> -->

        <div class="btn">
            <input type="submit" value="Sign up" name="submit">
        </div>
    </form>
</div>



<?php include 'templates/footer.php' ?>

</html>