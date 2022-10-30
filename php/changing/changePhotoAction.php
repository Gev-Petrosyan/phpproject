<?php

    session_start();
    include "../database.php";

    if (empty($_SESSION["username"])) {
        header("location: ../../index.php");
    }
    else {
        $username = $_SESSION["username"];

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $image = $row["image"];
    }

    if (isset($_POST["change"]) && isset($_FILES["file"]) && $_FILES["file"]["size"] <= 1 * 1024 * 1024) {

        $id = $_SESSION["id"];
        $file = $_FILES["file"];

        $fileName = $file["name"];
        $fileError = $file["error"];
        $fileTmp = $file["tmp_name"];

        $fileExt = explode('.', $fileName);
        $fileCheck = strtolower(end($fileExt));

        $destinationFile = '../../image/' . $fileName;
        move_uploaded_file($fileTmp, $destinationFile);

        $conn->query("UPDATE users SET image='$fileName' WHERE id='$id'");

        $error = null;
        $alert = "You have changed your photo!";
        header("location: ./changePhoto.php?alert=$alert");
    }
    else if ($_FILES["file"]["size"] > 1 * 1024 * 1024) {
        $alert = null;
        $error = "Photo size limit max 1 mb!";
        header("location: ./changePhoto.php?error=$error");
    }
    else {
        $alert = null;
        $error = "You don't download your photo!";
        header("location: ./changePhoto.php?error=$error");
    }

?>