<?php

    $hostdb = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $db = "todolist_app";

    $conn = mysqli_connect($hostdb, $usernamedb, $passworddb, $db);

    if (!$conn) {
        die("Connect error - " . mysqli_connect_error());
    }

?>