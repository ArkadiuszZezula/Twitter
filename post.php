<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');
require_once ('src/Tweet.php');
require_once ('src/Comment.php');



var_dump($_GET);  //Posty innych uzytkownikow
if (isset($_GET['userId']) and isset($_GET['tweetId'])) {
    echo "<a href='index.php'>Return to main page</a><br><br><br>";

    $id = $_GET['userId'];
    $tweetId = $_GET['tweetId'];

    $sql = "SELECT * FROM Users 
            JOIN Tweet ON Users.id=Tweet.userId    
            WHERE Users.id=" . $id . " AND Tweet.id=" . $tweetId . "";
    $result = $conn->query($sql);

    $sql2 = "SELECT * FROM Tweet 
            JOIN Comments ON Tweet.id=Comments.post_id
            JOIN Users ON Tweet.userId=Users.id
            WHERE Tweet.id =" . $tweetId . "";

    $result2 = $conn->query($sql2);
    ?>  <!-- formularz komentarza -->

    <div class="container">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-14 col-sm-4 col-md-4 col-lg-4">

            <?php
            foreach ($result as $row) {  // Wypisanie tweeta
                echo "<h3>" . $row['username'] . "</h3>" . " napisał: <br>";
                //echo "<a href='post.php?tweetId=" . $row['id'] . "&userId=" . $row['userId'] . "'>Tweet z dnia: " . $row['creationDate'] . "</a><br>";
                echo $row['text'] . "<br>" . "dnia: ";
                echo $row['creationDate'] . "<br><br>";

                foreach ($result2 as $row) {  // Wypisanie komentarzy
                    echo "Użytkownik: " . $row['username'] . " <br> *  " . $row['comments_content'] . "  * <br>" . "Dodano dnia: " . $row['comments_date'] . "<br><br>";
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
                            <button type="submit" class="btn btn-primary">Send</button>
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
            $commentDate = date('Y-m-d h:m:s ');

            $Comment1 = new Comment();
            $Comment1->setCommentsContent($com);
            $Comment1->setPostId($tweetId);
            $Comment1->setAutorId($id);
            $Comment1->setCommentsDate($commentDate);
            //var_dump($Comment1);
            $Comment1->saveToDB($conn);


            // var_dump($_SESSION);
//header ("location: index.php?allTweets");
        }
        echo "<br><br><a href='index.php'>Return to main page</a><br>";
        return;
    }
}









//pobieranie treści wpisu razem z danymi autora (join) i komentarzami do wpisu
//SELECT * FROM post p 
//JOIN users u ON p.author_id = u.id
//        
//JOIN comment c ON c.post_id = p.id
//JOIN users u2 ON u2.id = c.author_id
//        
//WHERE p.id = $_GET['id'];
?>
<!--Wyświetlanie treści wpisu-->
<!--Wyświetlanie komentarzy do wpisu (autor jako klikalny link)-->
