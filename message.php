<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');
require_once ('src/Tweet.php');
require_once ('src/Comment.php');
require_once ('src/Message.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Message</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            if (isset($_GET['messageId'])) {

                $message1 = Message::loadMessageByIdRec($conn, $_GET['messageId']);   // wiadomości odebrane
                $recId = $message1->getRecId();
                if ($_SESSION['user_id'] == $recId) {
                    echo "User " . "<a href='user.php?id=" . $message1->getSendId() . "'><h4>" . $message1->getUserName() . "</h4></a>" . " send: <br><h4> * " . $message1->getMessagesContent() . " * </h4>";
                    if ($message1->getDisplay() != 0) {
                        "It is message read";
                        echo "<br><a href='index.php'>Return to main page</a><br><br>";
                    } else {
                        echo "It is new message";
                        $message1->saveToDBDisplay($conn, $message1->getId());
                        echo "<br><a href='index.php'>Return to main page</a><br><br>";
                    }
                }

                $message2 = Message::loadMessageByIdSend($conn, $_GET['messageId']);
                $SendId = $message2->getSendId();
                if ($_SESSION['user_id'] == $SendId) {
                    echo "You send to" . "<a href='user.php?id=" . $message2->getRecId() . "'><h4>" . $message2->getUserName() . "</h4></a>" . " message: <br><h4> * " . $message2->getMessagesContent() . " * </h4>";
                    echo "<br><a href='index.php'>Return to main page</a><br><br>";
                }
            }
            ?>
        </div>
    </body>
</html>

<?php


//pobierz wiadomość z bazy na podstawie $_GET['id']
//JOIN users aby pobrać nazwę nadawcy i jeszcze raz JOIN users żeby pobrać nazwę odbiorcy

//SELECT * FROM Message m
//JOIN users ua ON m.author_id = ua.id
//JOIN users ur ON ur.id = m.recipient
//WHERE m.id = $_GET['id']
//        - mysql_real_escape_string();



