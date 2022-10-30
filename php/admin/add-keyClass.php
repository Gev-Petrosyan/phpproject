<?php

Class key {

    private $key_level;
    private $key_code;

    public function __construct($key_level, $key_code) {
        $this->key_level = $key_level;
        $this->key_code = $key_code;
    }

    public function checking() {
        if ($this->checkingDb() === false) {
            $alert = null;
            $error = "Some problems have occurred, please try again!";
            header("location: ./add-key.php?error=$error");
            exit();
        }
        else {
            $error = null;
            $alert = "Key code has been completed - " . $this->key_code . "!";

            include "../database.php";
            $conn->query("INSERT INTO `key_codes` (`id`, `key_code`, `key_level`) VALUES (NULL, '$this->key_code', '$this->key_level')");
            header("location: ./add-key.php?alert=$alert");
        }
    }

    private function checkingDb() {
        $result;
        include "../database.php";

        $checking = $conn->query("SELECT * FROM key_codes WHERE key_code='$this->key_code'");

        if ($checking->num_rows > 0) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>