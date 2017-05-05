<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');
require_once ('src/Tweet.php');
require_once ('src/Comment.php');

  
if (isset($_GET['userId']) and isset($_GET['tweetId'])) { //Posty innych uzytkownikow
    echo "<a href='index.php'>Return to main page</a><br><br><br>";
    $id = $_GET['userId'];
    $tweetId = $_GET['tweetId'];
    ?>  <!-- formularz komentarza -->
    <div class="container">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-14 col-sm-4 col-md-4 col-lg-4">

            <?php
            $loadTweet = Tweet::loadTweetById($conn, $tweetId);
            $loadUser = User::loadUserById($conn, $id);
            $loadComment = Comment::loadCommentById($conn, $id);
            $loadPost = Comment::loadAllCommentsByPostId($conn, $tweetId);

            echo "<a href='user.php?id=" . $loadUser->getId() . "'><h3>" . $loadUser->getUserName() . "</h3></a>" . " tweet: <br>";
            echo "* " . $loadTweet->getText() . " * <br>";
            echo "Day: " . $loadTweet->getCreationDate() . "   <hr>";
            echo "<a href='" . $_SERVER['REQUEST_URI'] . "&displayAllComments'> Show comments: " . count($loadPost) . " </a>";
            if (($_GET['tweetId'] == $tweetId) && (isset($_GET['displayAllComments']))) {
                Comment::seeAll($conn, $tweetId);
                echo "<br><a href='post.php?tweetId=" . $tweetId . "&userId=" . $id . "'> Collapse comments </a><hr>";
            }
        }
        ?>
    </div>
</div>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Comments</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="POST" role="form">
                        <legend>Add Comment</legend>
                        <div class="form-group">
                            <label for="">New Comment</label>
                            <input rows="4" cols="50" type="textarea" class="form-control" name="comment" id="comment" >
                        </div>
                        <button type="submit" class="btn btn-primary" >Send</button>
                    </form>


                </div>

            </div>
        </div>
    </body>
</html>


<?php
// dodawanie komentarzy
if (isset($_POST['comment'])) {
    if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {
        $id = $_SESSION['user_id'];
        $com = $_POST['comment'];
        $commentDate = date('Y-m-d H:i:s');

        $Comment1 = new Comment();
        $Comment1->setCommentsContent($com);
        $Comment1->setPostId($tweetId);
        $Comment1->setAutorId($id);
        $Comment1->setCommentsDate($commentDate);
        $Comment1->saveToDB($conn);

        header("location: " . $_SERVER['REQUEST_URI'] . "");
    }
}


echo "<br><br><a href='index.php'>Return to main page</a><br>";
return;
?>
