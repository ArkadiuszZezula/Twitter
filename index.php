<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/Tweet.php');
require_once ('src/User.php');

//var_dump($_SESSION);
?>


<!doctype html>
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
            if (($_SERVER['REQUEST_METHOD']) === "POST") {
                if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {

                    $user_id = $_SESSION['user_id'];
                    $text = $_POST['tweet'];
                    $creationDate = date('Y-m-d H:i:s');

                    $Tweet1 = new Tweet();
                    $Tweet1->setUserId($user_id);
                    $Tweet1->setText($text);
                    $Tweet1->setCreationDate($creationDate);
                    $Tweet1->saveToDB($conn);

                    echo "You added tweet: <br><h3>" . $Tweet1->getText($text) . "</h3><br>" . $Tweet1->getCreationDate($creationDate) . "<br>";
                    echo "<a href='index.php'>Return to main page</a><br>";
                    return;
                }
            }

            ?>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form action="index.php" method="POST" role="form">
                        <legend>Add Tweet</legend>
                        <div class="form-group">
                            <label for="">New Tweet</label>
                            <input rows="4" cols="50" type="textarea" class="form-control" name="tweet" id="tweet" >
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>

                    <div>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        echo "<a href='user.php?id=$user_id'><h3>All your Tweets</h3></a><br>";
                        ?>
                    </div>

                    <div>
                        <a href='index.php?Logout'><h4> Logout</h4></a><br>
                        <?php
                        if (isset($_GET['Logout'])) {
                            session_destroy();
                            header("location: login.php");
                        }
                        ?>
                    </div>

                    <div>
                        <a href='edit_user.php?edit'><h5> Edit profile</h5></a><br>
                    </div>

                </div>

            </div>
        </div>

        <div class="container">
            <?php
            $loadAllTweets = Tweet::loadAllTweets($conn); // załadowanie wszystkich tweetów
            ?>
        </div>

    </body>
</html>
