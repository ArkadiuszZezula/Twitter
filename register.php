<?php
session_start();
require_once ('utils/connection.php');
require_once ('src/Tweet.php');
require_once ('src/User.php');
echo "<a href='index.php'>Return to main page</a><br>";
if (($_SERVER['REQUEST_METHOD']) === "POST") {
    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $email = User::emailCheck($conn, $email);
    $userName = User::userNameCheck($conn, $userName);
    $password = User::passwordCheck($conn, $password);


    if ($email == "" || $userName == "" || $password == "") {
        return false;
    }


    $user1 = new User();
    $user1->setEmail($email);
    $user1->setUsername($userName);
    $user1->setHashedPassword($password);

    $user1->saveToDB($conn);

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);
    foreach ($result as $row) {
        $id = $row['id'];
        $hash = $row['hashed_password'];
    }

    // $user1 = User::loadUserById($conn, $id);
    var_dump($user1);
    $_SESSION['user_id'] = $id;
    $_SESSION['pass'] = $hash;
    if (isset($_SESSION['user_id']) && isset($_SESSION['pass'])) {
        header("location: index.php");
    }

    $conn->close();
    $conn = null;
}
?>
<!--Formularz do rejestracji użytkownika-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form action="register.php" method="post" role="form">
                        <legend>Register User</legend>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail...">
                        </div>

                        <div class="form-group">
                            <label for="">User name</label>
                            <input type="text" class="form-control" name="userName" id="userName"
                                   placeholder="User name...">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" id="password"
                                   placeholder="Password...">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
            </div>
        </div>
    </body>
</html>