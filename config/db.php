<?php

    require "config.php";
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if(mysqli_connect_errno()){
        echo "Failed to connect". mysqli_connect_errno();
    }
