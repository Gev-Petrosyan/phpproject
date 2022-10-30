<?php

    if (isset($_POST["submit"])) {
            
        $name = $_POST["name"];
        $date = $_POST["date"];

        include "../database.php";
        include "addListClass.php";

        $result = new AddList($name, $date);       
        $result->checking();       

    }

?>