<?php

    if (isset($_POST["submit"])) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        include "database.php";
        include "sign-inClass.php";

        $result = new SignIn($username, $password);
        $result->checking();

    }

?>