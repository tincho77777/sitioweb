<?php
session_start();

if ($_POST) {
    if (($_POST['user'] == "MartinAlvarez7") && ($_POST['password'] == "12345")) {

        //si quiero hacer una validacion con la base de datos puedo usar los datps del boton select preguntando por
        //la contraseña y el usuario
        $_SESSION['user'] == "ok";
        $_SESSION['userName'] = "Martin Alvarez";
        
        header('Location:start.php');
    } else {
        $message = "ERROR: The username and/or password are incorrect!";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Website Administrator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if (isset($message)) {    ?>

                            <div class="alert alert-danger" role="alert">
                                <?php echo $message;    ?>
                            </div>

                        <?php }  ?>

                        <form method="POST">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="user">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <br>

</body>

</html>