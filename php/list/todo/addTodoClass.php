<?php

class AddTodo {

    private $id;
    private $todo;

    public function __construct($id, $todo) {
        $this->id = $id;
        $this->todo = $todo;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ../list.php?id=$this->id");
            exit();
        }
        else {
            include "../../database.php";
            $conn->query("INSERT INTO `todos` (`id`, `list`, `todo`, `checkbox`) VALUES (NULL, '$this->id', '$this->todo', 'false')");
            header("location: ../list.php?id=$this->id");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->id) || empty($this->todo)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>