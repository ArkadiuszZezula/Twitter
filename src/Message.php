<?php

class Message {

    public $id;
    public $send_id;
    public $rec_id;
    public $messages_content;
    public $display;

    public function __construct() {
        $this->id = -1;
        $this->send_id = "";
        $this->rec_id = "";
        $this->messages_content = "";
        $this->display = 0;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserName() {
        return $this->username;
    }

    public function getSendId() {
        return $this->send_id;
    }

    public function setSendId($sendId) {
        $this->send_id = $sendId;
    }

    public function getRecId() {
        return $this->rec_id;
    }

    public function setRecId($recId) {
        $this->rec_id = $recId;
    }

    public function getMessagesContent() {
        return $this->messages_content;
    }

    public function setMessagesContent($messagesContent) {
        $this->messages_content = $messagesContent;
    }

    public function getDisplay() {
        return $this->display;
    }

    public function setDisplay($display) {
        $this->display = $display;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Messages(send_id, rec_id, messages_content, display)
                    VALUES ('$this->send_id', "
                    . "'$this->rec_id', "
                    . "'$this->messages_content', "
                    . "'$this->display')";

            $result = $connection->query($sql);
            // echo $connection->error;
            // var_dump($result);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE Messages SET send_id='$this->send_id',
                                     rec_id='$this->rec_id',
                                     messages_content='$this->messages_content', 
                                     display='$this->display',    
                                     WHERE id=$this->id";

            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    public function saveToDBDisplay(mysqli $connection, $id) {
        $sql = "UPDATE Messages SET  display='1'    
                                     WHERE id=$id";

        $result = $connection->query($sql);
        if ($result == true) {
            return true;
        }
    }

    static public function loadMessageById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Messages WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];

            return $loadedTweet;
        }
        return null;
    }

    static public function loadMessageByIdRec(mysqli $connection, $id) {
        $sql = "SELECT Messages.id AS mes_id,send_id,rec_id,messages_content,username,display FROM Messages "
                . "JOIN Users ON Messages.send_id=Users.id "
                . "WHERE Messages.id=$id ";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedMessage = new Message();
            $loadedMessage->id = $row['mes_id'];
            $loadedMessage->send_id = $row['send_id'];
            $loadedMessage->rec_id = $row['rec_id'];
            $loadedMessage->messages_content = trim($row['messages_content']);
            $loadedMessage->display = $row['display'];
            $loadedMessage->username = $row['username'];
            return $loadedMessage;
        }
        return null;
    }

    static public function loadMessageByIdSend(mysqli $connection, $id) {
        $sql = "SELECT Messages.id AS mes_id,send_id,rec_id,messages_content,username,display FROM Messages "
                . "JOIN Users ON Messages.rec_id=Users.id "
                . "WHERE Messages.id=$id ";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedMessage = new Message();
            $loadedMessage->id = $row['mes_id'];
            $loadedMessage->send_id = $row['send_id'];
            $loadedMessage->rec_id = $row['rec_id'];
            $loadedMessage->messages_content = trim($row['messages_content']);
            $loadedMessage->display = $row['display'];
            $loadedMessage->username = $row['username'];
            return $loadedMessage;
        }
        return null;
    }

    static public function loadAllMessagesSend(mysqli $connection, $id) {  // wiadomośći wysłane
        $sql = "SELECT Messages.id AS mes_id,send_id,rec_id,messages_content,username,display, Users.username FROM Messages 
                JOIN Users ON Messages.rec_id=Users.id 
                WHERE Messages.send_id=$id ";

        $result = $connection->query($sql);
        echo "<h4>Send messages:</h4><hr>";
        if ($result == true && $result->num_rows != 0) {

            foreach ($result as $row) {
                if (mb_strlen($row['messages_content']) > 30) {
                    $row['messages_content'] = substr($row['messages_content'], 0, 29);
                    $row['messages_content'] .= "...";
                }
                echo "To: <a href='user.php?id=" . $row['rec_id'] . "'><h4>" . $row['username'] . "</a>"
                . "  <a href='message.php?messageId=" . $row['mes_id'] . "'><h4>" . $row['messages_content'] . "</h4></a><br>";
                if ($row['display'] = 0) {
                    echo "<h6>New message</h6><br><br>";
                }
            }
        }
    }
    
    static public function loadAllMessagesRec(mysqli $connection, $id) {  // wiadomośći odebrane
        $sql = "SELECT Messages.id AS mes_id,send_id,rec_id,messages_content,username,display, Users.username FROM Messages 
                JOIN Users ON Messages.send_id=Users.id 
                WHERE Messages.rec_id=$id ";

        $result = $connection->query($sql);
        echo "<h4>Receive messages:</h4><hr>";
        if ($result == true && $result->num_rows != 0) {

            foreach ($result as $row) {
                if (mb_strlen($row['messages_content']) > 30) {
                    $row['messages_content'] = substr(trim($row['messages_content']), 0, 29);
                    $row['messages_content'] .= "...";
                }
                echo "From: <a href='user.php?id=" . $row['send_id'] . "'><h4>" . $row['username'] . "</a>"
                . "  <a href='message.php?messageId=" . $row['mes_id'] . "'><h4>" . $row['messages_content'] . "</h4></a><br>";
                if ($row['display'] = 0) {
                    echo "<h6>New message</h6><br><br>";
                }
            }
        }
    }

}
