<?php

class Comment {

    public $id;
    public $comments_content;
    public $post_id;
    public $autor_id;
    public $comments_date;

    public function __construct() {
        $this->id = -1;
        $this->comments_content = "";
        $this->post_id = "";
        $this->autor_id = "";
        $this->comments_date = "";
    }

    public function getUserName() {
        return $this->username;
    }

    public function setCommentsContent($commentsContent) {
        if (mb_strlen($commentsContent) > 60) {
            $commentsContent = substr($commentsContent, 0, 59);
            $this->comments_content = $commentsContent;
        } else {
            $this->comments_content = $commentsContent;
        }
    }

    public function getCommentsContent() {
        return $this->comments_content;
    }

    public function setUserId($comments_content) {
        $this->comments_content = $comments_content;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function setPostId($postId) {
        $this->post_id = $postId;
    }

    public function getAutorId() {
        return $this->autor_id;
    }

    public function setAutorId($autorId) {
        $this->autor_id = $autorId;
    }

    public function getCommentsDate() {
        return $this->comments_date;
    }

    public function setCommentsDate($commentsDate) {
        $this->comments_date = $commentsDate;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            $sql = "INSERT INTO Comments (comments_content, post_id, autor_id, comments_date)
                    VALUES ('$this->comments_content', "
                    . "'$this->post_id', "
                    . "'$this->autor_id', "
                    . "'$this->comments_date')";

            $result = $connection->query($sql);
            // echo $connection->error;
            // var_dump($result);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE Comments SET comments_content='$this->comments_content',
                                     post_id='$this->post_id',
                                     autor_id='$this->autor_id',
                                     comments_date='$this->comments_date'
                                     WHERE id=$this->id";

            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function loadCommentById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Comments WHERE id=$id "
                . "ORDER BY Comments.comments_date DESC";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->comments_content = $row['comments_content'];
            $loadedComment->post_id = $row['post_id'];
            $loadedComment->autor_id = $row['autor_id'];
            $loadedComment->comments_date = $row['comments_date'];

            return $loadedComment;
        }
        return null;
    }

    static public function loadAllCommentsByPostId(mysqli $connection, $id) {
        $sql = "SELECT * FROM Comments WHERE post_id = $id "
                . "ORDER BY Comments.comments_date DESC";
        $ret = [];
        $result = $connection->query($sql);
        foreach ($result as $row) {

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->comments_content = $row['comments_content'];
            $loadedComment->post_id = $row['post_id'];
            $loadedComment->autor_id = $row['autor_id'];
            $loadedComment->comments_date = $row['comments_date'];

            $ret [] = $loadedComment;
        }
        return $ret;
    }

    static public function seeAll(mysqli $connection, $id) {


        $sql = "SELECT * FROM Comments "
                . "JOIN Users ON Comments.autor_id=Users.id "
                . "WHERE Comments.post_id=$id "
                . "ORDER BY Comments.comments_date DESC";

        $result = $connection->query($sql);
        foreach ($result as $row) {

            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->username = $row['username'];
            $loadedComment->comments_content = $row['comments_content'];
            $loadedComment->post_id = $row['post_id'];
            $loadedComment->autor_id = $row['autor_id'];
            $loadedComment->comments_date = $row['comments_date'];

            echo "<br><br>" . "<a href='user.php?id=" . $loadedComment->autor_id . "'><h4>" . $loadedComment->username . "</h4></a>" . "commented :<br> * " . $loadedComment->comments_content . " * <br> day: " . $loadedComment->comments_date . "<br>";
        }
    }

}
