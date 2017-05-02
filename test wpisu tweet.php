<?php
session_start();
require_once ('utils/connection.php');
//require_once ('utils/check_login.php');
require_once ('src/Comment.php');
//require_once ('src/User.php');
//require_once ('src/Tweet.php');

$Comment1 = new Comment();
$id = $_SESSION['user_id'];
$Comment1->setCommentsContent('Pierwszyaaa  2');
$Comment1->setPostId(43);
$Comment1->setAutorId($id);
$Comment1->setCommentsDate('2017-02-10');

$Comment1->saveToDB($conn);
var_dump($Comment1);

$conn->close();
$conn = null;




// dodanie uzytkownika do bazy

?>

