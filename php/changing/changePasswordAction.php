<?php

    if (isset($_POST["change"])) {
        $newPassword = $_POST["newPassword"];
        $confirmNewPassword = $_POST["confirm-newPassword"];

        include "../database.php";
        include "changePasswordClass.php";

        $result = new ChangePassword($newPassword, $confirmNewPassword);
        $result->checking();
    }

?>