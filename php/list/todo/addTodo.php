<?php

    if (isset($_POST["submit"])) {
        
        $id = $_POST["id"];
        $todo = $_POST["todo"];

        include "../../database.php";
        include "addTodoClass.php";

        $result = new AddTodo($id, $todo);       
        $result->checking();       

    }

?>