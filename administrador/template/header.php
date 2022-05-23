<?php

session_start();
if(!isset($_SESSION['user'])){  //si no hay usuario logueado mandame a el login
// header("Location:../index.php"); este si lo pongo me redirecciona a la pagina principal no al login
}else{
    if($_SESSION['user']=="ok"){
        $userName = $_SESSION['userName'];
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

<?php    $url = "http://".$_SERVER['HTTP_HOST']."/sitioweb"     ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Website Administrator</a>
            <a class="nav-item nav-link" href="<?php  echo $url."/administrador/start.php";   ?>">Home</a>
            <a class="nav-item nav-link" href="<?php  echo $url."/administrador/section/products.php";   ?>">Books</a>
            <a class="nav-item nav-link" href="<?php  echo $url."/administrador/section/close.php";   ?>">Close</a>
            <a class="nav-item nav-link" href="<?php  echo $url;   ?>">See Website</a>
        </div>
    </nav>
    <br>

    <div class="container">
        <div class="row">