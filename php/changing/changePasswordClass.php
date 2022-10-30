<?php

session_start();

class ChangePassword {
    
    private $newPassword;
    private $confirmNewPassword;
    
    public function __construct($newPassword, $confirmNewPassword) {
        $this->newPassword = $newPassword;
        $this->confirmNewPassword = $confirmNewPassword;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            $alert = null;
            $error = "Fill all the lines!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else if ($this->invalidNewPassword() === false) {
            $alert = null;
            $error = "Prohibited new password was used!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else if ($this->invalidConfirmNewPassword() === false) {
            $alert = null;
            $error = "Prohibited confirm new password was used!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else if ($this->confirmPassword() === false) {
            $alert = null;
            $error = "Password doesn't match!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else if ($this->lengthNewPassword() === false) {
            $alert = null;
            $error = "Password must include at least 6 and no more than 20 characters!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else if ($this->lengthConfirmNewPassword() === false) {
            $alert = null;
            $error = "Password must include at least 6 and no more than 20 characters!";
            header("location: changePassword.php?error=$error");
            exit();
        }
        else {
            $error = null;
            $alert = "Your password has been changed!";
            $id = $_SESSION["id"];
            include "../database.php";
            $password = md5($this->newPassword);
            $conn->query("UPDATE users SET password='$password' WHERE id='$id'");
            header("location: changePassword.php?alert=$alert");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->newPassword) || empty($this->confirmNewPassword)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidNewPassword() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->newPassword)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidConfirmNewPassword() {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->confirmNewPassword)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function confirmPassword() {
        $result;
        if ($this->newPassword === $this->confirmNewPassword) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    private function lengthNewPassword() {
        $result;
        if (strlen($this->newPassword) < 6 || strlen($this->newPassword) > 20) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function lengthConfirmNewPassword() {
        $result;
        if (strlen($this->confirmNewPassword) < 6 || strlen($this->confirmNewPassword) > 20) {
            $result = false;
        }
        else {  
            $result = true;
        }
        return $result;
    }

}

?>