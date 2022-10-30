<?php

class Edit {

    private $id;
    private $idLists;
    private $todo;

    public function __construct($id, $idLists, $todo) {
        $this->id = $id;
        $this->idLists = $idLists;
        $this->todo = $todo;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ../list.php?id=$this->idLists");
            exit();
        }
        else {
            include "../../database.php";
            $conn->query("UPDATE todos SET todo='$this->todo' WHERE id='$this->id'");
            header("location: ../list.php?id=$this->idLists");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->id) || empty($this->idLists) || empty($this->todo)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>