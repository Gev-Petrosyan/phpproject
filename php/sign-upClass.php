<?php

class SignUp {
    
    private $username;
    private $password;
    private $confirm_password;
    private $gender;
    private $key_code;

    public function __construct($username, $password, $confirm_password, $gender, $key_code) {
        $this->username = $username;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->gender = $gender;
        $this->key_code = $key_code;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            $alert = null;
            $error = "Fill all the lines!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->invalidUsername() === false) {
            $alert = null;
            $error = "Prohibited username was used!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->invalidPassword() === false) {
            $alert = null;
            $error = "Prohibited password was used!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->invalidConfirmPassword() === false) {
            $alert = null;
            $error = "Prohibited confirm password was used!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->invalidGender() === false) {
            $alert = null;
            $error = "You must choose your gender!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->invalidKeyCode() === false) {
            $alert = null;
            $error = "Prohibited key code was used!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->confirmPassword() === false) {
            $alert = null;
            $error = "Password doesn't match!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->lengthUsername() === false) {
            $alert = null;
            $error = "Username must include at least 3 and no more than 20 characters!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->lengthPassword() === false) {
            $alert = null;
            $error = "Password must include at least 6 and no more than 20 characters!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->checkingUsernameDb() === false) {
            $alert = null;
            $error = "This username already exist!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else if ($this->checkingKeyCodeDb() === false) {
            $error = "Key code is wrong!";
            header("location: ../register.php?error=$error");
            exit();
        }
        else {
            $error = null;
            $alert = "Congratulations! You have registered!";

            include "database.php";
            $password = md5($this->password);

            $checking = $conn->query("SELECT * FROM key_codes WHERE key_code='$this->key_code'");
            $row = $checking->fetch_assoc();

            $key_level = $row["key_level"];
            $conn->query("INSERT INTO `users` (`id`, `username`, `password`, `gender`, `level`, `image`) VALUES (NULL, '$this->username', '$password', '$this->gender', '$key_level', '')");
            $conn->query("DELETE FROM key_codes WHERE key_code='$this->key_code'");

            header("location: ../register.php?alert=$alert");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->username) || empty($this->password) || empty($this->confirm_password) || empty($this->gender) || empty($this->key_code)) {
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

    private function invalidConfirmPassword() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->confirm_password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidKeyCode() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->key_code)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }


    private function confirmPassword() {
        $result;
        if ($this->password === $this->confirm_password) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function lengthUsername() {
        $result;
        $lengthUsername = strlen($this->username);
        if ($lengthUsername < 3 || $lengthUsername > 20) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function lengthPassword() {
        $result;
        $lengthPassword = strlen($this->password);
        if ($lengthPassword < 6 || $lengthPassword > 20) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidGender() {
        $result;
        if ($this->gender === "Gender") {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function checkingUsernameDb() {
        $result;
        include "database.php";

        $checking = $conn->query("SELECT * FROM users WHERE username='$this->username'");

        if ($checking->num_rows > 1) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function checkingKeyCodeDb() {
        $result;
        include "database.php";

        $checking = $conn->query("SELECT * FROM key_codes WHERE key_code='$this->key_code'");

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