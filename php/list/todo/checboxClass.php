<?php

class Checkbox {

    private $id;
    private $idLists;
    private $checkbox;
    
    public function __construct($id, $idLists, $checkbox) {
        $this->id = $id;
        $this->idLists = $idLists;
        $this->checkbox = $checkbox;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ../list.php?id=$this->idLists");
            exit();
        }
        else {
            include "../../database.php";
            if ($this->checkbox == "false") {
                $conn->query("UPDATE todos SET checkbox='true' WHERE id='$this->id'");
            } else {
                $conn->query("UPDATE todos SET checkbox='false' WHERE id='$this->id'");
            }
            header("location: ../list.php?id=$this->idLists");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->id) || empty($this->idLists) || empty($this->checkbox)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>