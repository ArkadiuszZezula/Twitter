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

    public function setCommentsContent($commentsContent) {
        $this->comments_content = $commentsContent;
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
        $sql = "SELECT * FROM Comments WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedComment = new Tweet();
            $loadedComment->id = $row['id'];
            $loadedComment->comments_content = $row['comments_content'];
            $loadedComment->post_id = $row['post_id'];
            $loadedComment->autor_id = $row['autor_id'];
            $loadedComment->comments_date = $row['comments_date'];

            return $loadedComment;
        }
        return null;
    }

}
