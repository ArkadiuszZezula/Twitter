<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');
require_once ('src/Tweet.php');
require_once ('src/Message.php');
require_once ('src/Comment.php');
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Twitter</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <?php
            if ($_GET['id'] == $_SESSION['user_id']) {
                if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {// Wszystkie moje tweety i moja strona
                    echo "<a href='messages.php'>Messages</a><br>";
                    echo "<a href='index.php'>Return to main page</a><br><br>";
                    $userById = User::loadUserById($conn, $_SESSION['user_id']);
                    echo "Witaj na swoim profilu" . " <h1>" . $userById->getUsername() . "</h1>" . "Oto Twoje tweety: <br>";

                    $id = $_GET['id'];
                    $allTweetsByUserId = User::loadAllTweetsByUserId($conn, $id);
                }
                echo "<br><a href='index.php'>Return to main page</a><br>";
                return;
            } else { // Strona i tweety innych użytkowników
                echo "<a href='index.php'>Return to main page</a>";
                $byUserId = User::loadUserById($conn, $_GET['id']);
                echo " <h2>" . $byUserId->getUsername() . "</h2>" . "Tweety użytkownika " . $byUserId->getUsername() . ": <br><hr>";
                $id = $_GET['id'];
                $allTweetsByUserId = User::loadAllTweetsByUserId($conn, $id);
                ?>

            </div>
        </body>
    </html>



    <?php
//sprawdzić czy użytkownik jest zalogowany
//pobrać dane użytkownika i wszystkie jego wpisy
//SELECT * FROM User u JOIN post p ON p.author_id = u.id WHERE u.id = $_GET['id'];
//SELECT p.*, COUNT(c.id) FROM post p 
//JOIN comment c ON c.post_id = p.id
//WHERE p.author_id = $_GET['id']
//GROUP BY p.id; - lista wpisów wraz z liczbą komentarzy
    ?>

    <div class="container">
        <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="POST" role="form">
            <legend>Send Message</legend>
            <div class="form-group">
                
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                
                <label for="">New Message</label>
                <textarea rows="4" cols="50" type="textarea" class="form-control" name="message" id="message" >
                </textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <?php
    if (($_SERVER['REQUEST_METHOD']) === "POST") {
        if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {

            $send_id = $_SESSION['user_id'];
            $rec_id = $_GET['id'];
            $messagesContent = $_POST['message'];

            $message1 = new Message();
            $message1->setSendId($send_id);
            $message1->setRecId($rec_id);
            $message1->setMessagesContent($messagesContent);
            $message1->saveToDB($conn);

            echo "Wysłałeś wiadomość do użytkownika ".$byUserId->getUsername()." <br>";
            echo "<a href='index.php'>Return to main page</a><br>";
            return;
        }
    }
}
?>

<!--Formularz do wysyłania wiadomości do użytkownika-->

<!--Lista wpisów użytkownika-->


