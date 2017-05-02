<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/Tweet.php');

if(isset($_SESSION['user_id']) && ($_SESSION['pass'])) {   
    
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM Users JOIN Tweet ON
            Users.id=Tweet.userId
            WHERE Users.id=".$id;
    $result = $conn->query($sql);

    foreach ($result as $row) {
        echo "<h2>" . $row['username'] . "</h2>";
        echo "Wpis z dnia: " . $row ['creationDate'] . "<br>Treść wpisu: <br> *" . $row['text'] . " *<br><br>";
    }
    
} 

$conn->close();
$conn = null;




