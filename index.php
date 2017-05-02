<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/Tweet.php');
require_once ('src/User.php');
//Sprawdź czy użytkownik jest zalogowany
var_dump($_SESSION);
if (($_SERVER['REQUEST_METHOD']) === "POST") {
    if (isset($_SESSION['user_id']) && ($_SESSION['pass'])) {

        $user_id = $_SESSION['user_id'];
        $text = $_POST['tweet'];
        $creationDate = date('Y-m-d h:m:s ');

        $Tweet1 = new Tweet();
        $Tweet1->setUserId($user_id);
        $Tweet1->setText($text);
        $Tweet1->setCreationDate($creationDate);
        $Tweet1->saveToDB($conn);

        echo "Added tweet: <br>" . $Tweet1->getText($text) . "<br>" . $Tweet1->getCreationDate($creationDate) . "<br>";
        echo "<a href='index.php'>Return to main page</a><br>";
        return;
        // var_dump($_SESSION);
//header ("location: index.php?allTweets");
    }
}
//obsługa formularza dodawania wpisu
//pobieranie listy wpisu
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home page</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
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
                            echo "<a href='user.php?id=$user_id'><h2>All your Tweets</h2></a><br>";
                        ?>

                    </div>
                    <div>
                        <a href='index.php?Logout'><h3> Logout</h3></a><br>
                        <?php
                        if (isset($_GET['Logout'])) {
                            session_destroy();
                            header("location: login.php");
                        }
                        ?>
                    </div>
                    <div>
                        <a href='edit_user.php?edit'><h3> Edit profile</h3></a><br>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
<?php
$sql = "SELECT * FROM Users 
        JOIN Tweet ON Users.id=Tweet.userId
        ORDER BY creationDate DESC";
$result = $conn->query($sql);

foreach ($result as $row) {
    echo "<h3>" . $row['username'] . "</h3>";
    // echo "Wpis z dnia: " . $row ['creationDate'] . "<br>Treść wpisu: <br> *" . $row['text'] . " *<br><br>";
    if (mb_strlen($row['text']) > 20) {
        $row['text'] = substr($row['text'], 0, 19);
        $row['text'] .= "...";
    }
    echo "<a href='post.php?tweetId=" . $row['id'] . "&userId=" . $row['userId'] . "'>Tweet z dnia: " . $row['creationDate'] . "</a><br>";
    echo $row['text'] . "<br><br>";
}
?>






<!--  Formualrz dodawania wpisu  -->

<!--  Link do wiadomości zalogowanego użytkownika  -->
<!--  Link do edycji danych zalogowanego użytkownika  -->

<!--  Lista wpisów (jako linki do post.php?id=xxx   -->
