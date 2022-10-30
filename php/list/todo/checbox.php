<?php

        $id = $_GET["id"];
        $idLists = $_GET["idLists"];
        $checkbox = $_GET["checkbox"];

        include "../../database.php";
        include "checboxClass.php";

        $result = new Checkbox($id, $idLists, $checkbox);
        $result->checking();


?>