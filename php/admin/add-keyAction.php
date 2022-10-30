<?php

    if (isset($_POST["submit"])) {
        
        $key_level = $_POST["level"];
        $key_code = rand(000000, 999999);

        include "../database.php";
        include "add-keyClass.php";

        $result = new key($key_level, $key_code);
        $result->checking();

    }

?>