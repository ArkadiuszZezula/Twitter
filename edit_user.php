<?php
session_start();
require_once ('utils/connection.php');
require_once ('utils/check_login.php');
require_once ('src/User.php');

$id = $_SESSION['user_id'];
$user1 = User::loadUserById($conn, $id);
//var_dump($user1);

if (($_SERVER['REQUEST_METHOD']) === "POST") {

    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];


    $user1->setEmail($email);
    $user1->setUsername($userName);
    $user1->setHashedPassword($password);

    $user1->saveToDB($conn);
    
    echo "Zaktualizowano dane <br>";
    echo "<a href='index.php'>Return to main page</a><br>";
    return;
}



//sprawdzamy czy zalogowany
//obsługa formularza - z komunikatem, czy udało się zapisać zmiany
//pobieramy dane zalogowanego użytkownika
?>

<!--formularz do edycji danych użytkownika-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit profile</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form action="edit_user.php" method="post" role="form">
                        <legend>Edit Your Profile</legend>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Type new E-mail...">
                        </div>

                        <div class="form-group">
                            <label for="">User name</label>
                            <input type="text" class="form-control" name="userName" id="userName"
                                   placeholder="Type new User name...">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" id="password"
                                   placeholder="Type new Password...">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="form-group">
                    <a href='index.php'>Return to main page</a><br><br>    
                </div>
            </div>
        </div>
    </body>
</html>
