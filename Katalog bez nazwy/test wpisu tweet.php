<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/Tweet.php');

$Tweet1 = new Tweet();
$id = $_SESSION['user_id'];
$Tweet1->setUserId($id);
$Tweet1->setText("Kolejny wpis");
$Tweet1->setCreationDate("2017-02-20");

$Tweet1->saveToDB($conn);
var_dump($Tweet1);

$conn->close();
$conn = null;

// dodanie uzytkownika do bazy

?>

