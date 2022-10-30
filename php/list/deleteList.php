<?php

    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        include "../database.php";
        include "deleteListClass.php";

        $result = new DeleteList($id);
        $result->checking();

    }

?>