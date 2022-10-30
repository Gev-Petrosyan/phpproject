<?php

class Send {

    private $sender_message;
    private $receiver_message;
    private $message;
    private $id_chat;

    public function __construct($sender_message, $receiver_message, $message, $id_chat) {
        $this->sender_message = $sender_message;
        $this->receiver_message = $receiver_message;
        $this->message = $message;
        $this->id_chat = $id_chat;
    }

    public function checking() {
        if ($this->emptyInput() === false) {
            header("location: ./message.php?id=$this->id_chat");
            exit();
        }
        else {
            include "../database.php";
            $conn->query("INSERT INTO `messages` (`id`, `sender_message`, `receiver_message`, `message`) VALUES (NULL, '$this->sender_message', '$this->receiver_message', '$this->message')");
            header("location: ./message.php?id=$this->id_chat");
        }
    }

    private function emptyInput() {
        $result;
        if (empty($this->sender_message) || empty($this->receiver_message) || empty($this->message) || empty($this->id_chat)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}

?>