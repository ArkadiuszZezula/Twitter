<?php
require_once ('utils/connection.php');
require_once ('src/User.php');

$user1 = new User();

$user1->setEmail("nad@yahoo.com");
$user1->setUsername("Alojzy Nadzwyczajny");
$user1->setHashedPassword("master");

$user1->saveToDB($conn);
var_dump($user1);

$conn->close();
$conn = null;

// dodanie uzytkownika do bazy

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zadanie 1 - dodawanie produktów do bazy</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <form action="zadanie1_form.php" method="post" role="form">
                <legend>Add product</legend>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name...">
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" id="description"
                           placeholder="Description...">
                </div>

                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price"
                           placeholder="Price...">
                </div>
                <button type="submit" class="btn btn-primary">Add product</button>
            </form>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>
</body>
</html>
