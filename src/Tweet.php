<?php

class Tweet {

    public $id;
    public $userId;
    public $text;
    public $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->text = "";
        $this->creationDate = "";
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        if (mb_strlen($text) > 140) {
            $text = substr($text, 0, 139);
            $this->text = $text;
        } else {
            $this->text = $text;
        }
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Tweet(userId, text, creationDate)
                    VALUES ('$this->userId', "
                    . "'$this->text', "
                    . "'$this->creationDate')";

            $result = $connection->query($sql);
            // echo $connection->error;
            // var_dump($result);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE Tweet SET userId='$this->userId',
                                     text='$this->text',
                                     creationDate='$this->creationDate'
                                     WHERE id=$this->id";

            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function loadTweetById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Tweet WHERE id=$id";
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

    static public function loadAllTweetsByAutorId(mysqli $connection, $id) {
        $sql = "SELECT * FROM Tweet "
                . "JOIN Tweet ON Users.id=Tweet.userId "
                . "JOIN Comments On Comments.post_id=Tweet.id "
                . "WHERE Users.id = $id ";
        // . "ORDER BY Comments.comments_date DESC";
        $ret = [];
        $result = $connection->query($sql);
        foreach ($result as $row) {

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];

            $ret[] = $loadedTweet;
        }
        return $ret;
    }

    static public function loadAllTweets(mysqli $connection) {
        $sql = "SELECT Tweet.*, Users.username FROM Tweet  
        JOIN Users ON Tweet.userId=Users.id
        ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {

            foreach ($result as $row) {
                echo "<a href='user.php?id=" . $row['userId'] . "'><h3>" . $row['username'] . "</h3></a>";

                if (mb_strlen($row['text']) > 20) {
                    $row['text'] = substr($row['text'], 0, 19);
                    $row['text'] .= "...";
                }
                echo "<a href='post.php?tweetId=" . $row['id'] . "&userId=" . $row['userId'] . "'>" . $row['text'] . "</a><br>";
                echo $row['creationDate'] . "<br><br>";
            }
        }
    }

}
