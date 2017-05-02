<?php

class User {

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
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

}
