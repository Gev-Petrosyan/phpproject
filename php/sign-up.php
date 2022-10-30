<?php

    if (isset($_POST["submit"])) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm-password"];
        $gender = $_POST["gender"];
        $key_code = $_POST["key-code"];

        include "database.php";
        include "sign-upClass.php";

        $result = new SignUp($username, $password, $confirm_password, $gender, $key_code);
        $result->checking();

    }

?>