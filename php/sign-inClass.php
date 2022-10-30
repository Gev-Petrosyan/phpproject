<?php

session_start();

Class SignIn {

    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            $error = "Fill all the lines!";
            header("location: ../index.php?error=$error");
            exit();

        }
        else if ($this->invalidUsername() === false) {
            $error = "Prohibited sign was used in username!";
            header("location: ../index.php?error=$error");
            exit();
        }
        else if ($this->invalidPassword() === false) {
            $error = "Prohibited sign was used in password!";
            header("location: ../index.php?error=$error");
            exit();
        }
        else if ($this->checkingDb() === false) {
            $error = "Username or Password is wrong!";
            header("location: ../index.php?error=$error");
            exit();
        }
        else {
            $error = null;
            $_SESSION["username"] = $this->username;
            $_SESSION["password"] = md5($this->password);
            header("location: ../home.php");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->username) || empty($this->password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidUsername() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidPassword() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function checkingDb() {
        $result;
        include "database.php";

        $password = md5($this->password);
        $checking = $conn->query("SELECT * FROM users WHERE username='$this->username' AND password='$password'");

        if ($checking->num_rows === 0) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>