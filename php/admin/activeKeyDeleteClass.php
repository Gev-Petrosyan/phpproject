<?php

Class Delete {

    private $key_id;

    public function __construct($key_id) {
        $this->key_id = $key_id;
    }

    public function checking() {
        if ($this->emptyId() === false) {
            header("location: ./activeKey.php");
        }
        else {
            include "../database.php";
            $conn->query("DELETE FROM key_codes WHERE id='$this->key_id'");
            header("location: ./activeKey.php");
        }
    }

    private function emptyId() {
        $result;
        if (empty($this->key_id)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>