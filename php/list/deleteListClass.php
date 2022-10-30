<?php

Class DeleteList {

    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ../../home.php");
            exit();
        }
        else {
            include "../database.php";
            $conn->query("DELETE FROM lists WHERE id='$this->id'");
            $conn->query("DELETE FROM todos WHERE list='$this->id'");
            header("location: ../../home.php");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->id)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }


}

?>