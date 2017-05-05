<?php
session_start();
require_once ('utils/connection.php');
require_once ('src/User.php');

if (($_SERVER['REQUEST_METHOD']) === "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($_POST['email'] == $row['email'] && (password_verify($password, $row['hashed_password']))) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['pass'] = $row['hashed_password'];
        $user1 = User::loadUserById($conn, $row['id']);
        echo "Witaj " . $row['username'] . "<br>";
        echo "<a href='index.php'>Look at your Tweets</a><br>";
        header("location: index.php");
    } else {
        echo "Niepoprawny login lub hasło. ";
        session_destroy();
        return false;
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h3>Login</h3>
                    <form action="login.php" method="post" role="form">
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail...">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" id="password"
                                   placeholder="Password...">
                        </div>
                        <button type="submit" class="btn btn-primary" >Login</button>
                    </form>
                    <div class="form-group">
                        <a href="register.php">Register New User</a><br>
                    </div>
                </div>
                <div >

                    <a href='index.php?Logout'><h3> Logout</h3></a><br>
                    <?php
                    if (isset($_GET['Logout'])) {
                        session_destroy();
                        header("location: login.php");
                        echo "Log off correctly";
                        return;
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
