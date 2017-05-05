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
        <title>Messages</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            //var_dump($_SESSION);
            echo "<br><a href='index.php'>Return to main page</a><br><br>";
            $messages = Message::loadAllMessagesRec($conn, $_SESSION['user_id']);
            $messages = Message::loadAllMessagesSend($conn, $_SESSION['user_id']);
            echo "<br><a href='index.php'>Return to main page</a><br><br>";
            ?>
        </div>
    </body>
</html>
