<?php

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $idLists = $_GET["idLists"];

        include "../../database.php";
        include "todoDeleteClass.php";

        $result = new Delete($id, $idLists);
        $result->checking();
    }

?>