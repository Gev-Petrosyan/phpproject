<?php

class Delete {

    private $id;
    private $idLists;

    public function __construct($id, $idLists) {
        $this->id = $id;
        $this->idLists = $idLists;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ../list.php?id=$this->idLists");
            exit();
        }
        else {
            include "../../database.php";
            $conn->query("DELETE FROM todos WHERE id='$this->id'");
            header("location: ../list.php?id=$this->idLists");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->id) || empty($this->idLists)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>