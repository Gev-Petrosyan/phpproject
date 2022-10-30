<?php

class AddList {

    private $name;
    private $date;

    public function __construct($name, $date) {
        $this->name = $name;
        $this->date = $date;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            $alert  = null;
            $error = "Fill all the lins!";
            header("location: ./addList.php?error=$error");
            exit();
        }
        else if ($this->invalidName() === false) {
            $alert  = null;
            $error = "Prohibited list name was used!";
            header("location: ./addList.php?error=$error");
            exit();
        }
        else {
            include "../database.php";
            $error = null;
            $alert = "Your list has been added!";
            $conn->query("INSERT INTO `lists` (`id`, `name`, `date`) VALUES (NULL, '$this->name', '$this->date')");
            header("location: ./addList.php?alert=$alert");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->name) || empty($this->date)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidName() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->name)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>