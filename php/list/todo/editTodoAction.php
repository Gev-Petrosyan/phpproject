<?php

    if (isset($_POST["edit"])) {
        $id = $_POST["id"];
        $idLists = $_POST["idLists"];
        $todo = $_POST["todo"];

        include "../../database.php";
        include "editTodoClass.php";

        $result = new Edit($id, $idLists, $todo);
        $result->checking();
    }
    else if (isset($_POST["back"])) {
        $idLists = $_POST["idLists"];
        header("location: ../list.php?id=$idLists");
    }
    else {
        header("../../../home.php");
    }


?>