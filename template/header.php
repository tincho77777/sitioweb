<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Library</title>
</head>

<body>
<?php    $url = "http://".$_SERVER['HTTP_HOST']."/sitioweb"     ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Library</a>
            </li>

            <li class="nav-item left">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item left">
                <a class="nav-link" href="products.php">Books</a>
            </li>

            <li class="nav-item left">
                <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item left">
                <a class="nav-link left" href="<?php  echo $url."/administrador/index.php";   ?>">Administrator</a>
            </li>
        </ul>
    </nav>
    <br>

    <div class="container">
        <div class="row">