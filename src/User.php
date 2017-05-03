<?php

class User {

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setHashedPassword($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {

            if ($this->email == "" || $this->username == "" || $this->hashedPassword == "") {
                echo "Nie wprowadzono wszystkich wymaganych danych";
                return false;
            }


            $sql = "INSERT INTO Users(username, email, hashed_password)
                    VALUES ('$this->username', "
                    . "'$this->email', "
                    . "'$this->hashedPassword')";

            $result = $connection->query($sql);


            // echo $connection->error;
            // var_dump($result);
            if ($result == true) {
                $this->id = $connection->insert_id;
                echo "Utworzono nowy profil użytkownika " . $this->username;
                return true;
            }
        } else {

            $sql = "UPDATE Users SET username='$this->username',
                                     email='$this->email',
                                     hashed_password='$this->hashedPassword'
                                     WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            }
        }
        echo "Użytkownik o podanym e-mailu już istnieje";
        return false;
    }

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {

                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];

                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    static public function loadAllTweetsByUserId(mysqli $connection, $id) {
        $sql = "SELECT Tweet.*, COUNT(Comments.id) as NRCOMMENT FROM Tweet 
                JOIN Comments ON Comments.post_id = Tweet.id
                JOIN Users ON Users.id=Comments.autor_id
                WHERE Tweet.userId=$id
                GROUP BY Tweet.id";

        $result = $connection->query($sql);
        foreach ($result as $row) {

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];

            echo "<a href='post.php?tweetId=" . $row['id'] . "&userId=" . $row['userId'] . "'><h3>" . $row['text'] . "</h3></a>" . "dodany dnia: " . $row['creationDate'] . "<br>";
            echo "Komentarze: " . $row['NRCOMMENT'] . "<br><br>";
        }
    }

    static public function emailCheck($conn, $email) {
        if ($email == "") {
            echo "Please type your email <br>";
            return false;
        }
        $email = trim($email);
        $email = $conn->real_escape_string($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Please enter valid email address.<br>";
            session_destroy();
            $_POST = "";
            return false;
        }
        $sgl = "SELECT email FROM Users WHERE email='$email'";
        $result = $conn->query($sgl);
        $count = $result->num_rows;
        if ($count != 0) {
            echo "Provided Email is already in use <br>";
            session_destroy();
            $_POST = "";
            return false;
        }
        return $email;
    }

    static public function userNameCheck($conn, $userName) {
        if ($userName == "") {
            echo "Please type your User Name <br>";
            return false;
        }
        $userName = trim($userName);
        $userName = $conn->real_escape_string($userName);
        if (strlen($userName) < 3 && strlen($userName) > 40) {
            echo "User Name must have at least 3 characters or no more than 40 characters";
            return false;
        }
        if (!preg_match("/^[a-zA-Z ]+$/", $userName)) {
            echo"User Name must contain alphabets and space.";
            return false;
        }
        return $userName;
    }
    
    static public function passwordCheck($conn, $password) {
        if ($password == "") {
            echo "Please type your password<br>";
            return false;
        }
        $password = trim($password);
        $password = $conn->real_escape_string($password);
        if (strlen($password) < 6) {
            echo "Password must have at least 6 characters";
            return false;
        }
        return $password;
    }

}
