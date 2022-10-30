<?php

    $key_id = $_GET["key_id"];

    include "../database.php";
    include "activeKeyDeleteClass.php";

    $result = new Delete($key_id);
    $result->checking();

?>