<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');
require_once ('src/Tweet.php');
require_once ('src/Comment.php');


if($_GET['id'] == $_SESSION['user_id']) {
    if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {// Wszystkie moje posty
        echo "<a href='index.php'>Return to main page</a><br><br>";
        $id = $_GET['id'];
        $allTweetsByAutorId = User::loadAllTweetsByAutorId($conn, $id);
    /*echo "<a href='index.php'>Return to main page</a><br><br>";
        $id = $_SESSION['user_id'];
        $sql = "SELECT * FROM Users JOIN Tweet ON
            Users.id=Tweet.userId
            WHERE Users.id=" . $id;
        $result = $conn->query($sql);
        
        $sql2 = "SELECT * FROM Tweet 
            JOIN Comments ON Tweet.id=Comments.post_id
            JOIN Users ON Tweet.userId=Users.id
            WHERE Users.id =" . $id . "";

    $result2 = $conn->query($sql2);

        foreach ($result as $row) {
            echo "<h3>" . $row['username'] . "</h3>";
            echo "Wpis z dnia: " . $row ['creationDate'] . " <br>Treść wpisu: <br> *" . $row['text'] . " *<br><br>";
            // echo "<a href='post.php?tweetId=" . $row['id'] . "&userId=" . $row['userId'] . "'>Tweet z dnia: " . $row['creationDate'] . "</a><br>";
        foreach ($result2 as $row) {  // Wypisanie komentarzy
                    echo "Użytkownik: " . $row['username'] . " <br> *  " . $row['comments_content'] . "  * <br>" . "Dodano dnia: " . $row['comments_date'] . "<br><br>";
                }
            
        }*/
    } 
        echo "<br><a href='index.php'>Return to main page</a><br>";
    return;
    } else {
        echo "<a href='index.php'>Return to main page</a><br><br>";
        $id = $_GET['id'];
        $allTweetsByAutorId = User::loadAllTweetsByAutorId($conn, $id);
        
        /*$loadTweet = Tweet::loadTweetById($conn, $tweetId);
            $loadUser = User::loadUserById($conn, $id);
            $loadComment = Comment::loadCommentById($conn, $id);
            $loadPost = Comment::loadAllCommentsByPostId($conn, $tweetId);

            echo "<a href='user.php?id=" . $loadUser->getId() . "'><h3>" . $loadUser->getUserName() . "</h3></a>" . " napisał: <br>";
            echo "* " . $loadTweet->getText() . " * <br>";
            echo "dnia: " . $loadTweet->getCreationDate() . "   <hr>";
            echo "<a href='" . $_SERVER['REQUEST_URI'] . "&displayAllComments'> Pokaż komentarze: " . count($loadPost) . " </a>";
            if (($_GET['tweetId'] == $tweetId) && (isset($_GET['displayAllComments']))) {
                Comment::seeAll($conn, $tweetId);
                echo "<br><a href='post.php?tweetId=" . $tweetId . "&userId=" . $id . "'> Zwiń komentarze </a><hr>";
            } */
        
    }
    




//sprawdzić czy użytkownik jest zalogowany
//pobrać dane użytkownika i wszystkie jego wpisy
//SELECT * FROM User u JOIN post p ON p.author_id = u.id WHERE u.id = $_GET['id'];
//SELECT p.*, COUNT(c.id) FROM post p 
//JOIN comment c ON c.post_id = p.id
//WHERE p.author_id = $_GET['id']
//GROUP BY p.id; - lista wpisów wraz z liczbą komentarzy
?>

<!--Formularz do wysyłania wiadomości do użytkownika-->

<!--Lista wpisów użytkownika-->


