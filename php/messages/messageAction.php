<?php

    if (isset($_POST["send"])) {

        $sender_message = $_POST["sender_message"];
        $receiver_message = $_POST["receiver_message"];
        $message = $_POST["message"];
        $id_chat = $_POST["id_chat"];

        include "../database.php";
        include "messageClass.php";

        $result = new Send($sender_message, $receiver_message, $message, $id_chat);
        $result->checking();

    }

?>