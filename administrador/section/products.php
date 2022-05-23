<?php include('../template/header.php')      ?>
<!-- con los dos puntos salimos de una carpeta -->
<?php

//if ternario o validacion ternaria
//si hay algo en txtID va a ser igual a lo enviado por $_POST['txtID'] de lo contrario queda vacio 
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : ""; //para el ID
$txtName = (isset($_POST['txtName'])) ? $_POST['txtName'] : ""; //para el nombre
$txtImage = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : ""; //para la imagen
$action = (isset($_POST['action'])) ? $_POST['action'] : ""; //para las acciones

include('../config/db.php');   //conectandome a la base de datos

//eleccion del boton add/modify/cancel
switch ($action) {
    case "add":

        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (name, image) VALUES (:name, :image);");
        $sentenciaSQL->bindParam(':name', $txtName);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImage != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImage']['name'] : "image.jpg";
        //el nombre de la imagen esta formado por la fecha donde se subio mas el nombre del archivo, siempre que la imagen
        //no llegue vacia, si llega vacia se utiliza un nombre por defecto "image.jpg"

        $tmpImage = $_FILES['txtImage']['tmp_name'];

        if ($tmpImage != "") {
            move_uploaded_file($tmpImage, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':image', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:products.php");
        break;

    case "modify":

        $sentenciaSQL = $conexion->prepare("UPDATE libros SET name = :name WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':name', $txtName);
        $sentenciaSQL->execute();

        if ($txtImage != "") {  //validamos si tiene algo o esta vacio

            $fecha = new DateTime();
            $nombreArchivo = ($txtImage != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImage']['name'] : "image.jpg";

            $tmpImage = $_FILES['txtImage']['tmp_name'];
            move_uploaded_file($tmpImage, "../../img/" . $nombreArchivo);

            //aca borramos el archivo seleccionado que no queremos
            $sentenciaSQL = $conexion->prepare("SELECT image FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro['image']) && ($libro['image'] != "image.jpg")) { //si no esta vacio o es image.jpg por defecto

                if (file_exists("../../img/" . $libro['image'])) { //si existe el archivo image en la ruta especficada

                    unlink("../../img/" . $libro['image']); //borra el archivo de esa ruta

                }
            }
            //aca insertamos el nuevo que queremos modifiar
            $sentenciaSQL = $conexion->prepare("UPDATE libros SET image = :image WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->bindParam(':image', $nombreArchivo);
            $sentenciaSQL->execute();
        }
        header("Location:products.php");
        break;

    case "cancel":

        header("Location:products.php");
        break;

    case "select":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtName = $libro['name'];
        $txtImage = $libro['image'];

        break;

    case "delete":

        //aca busca la imagen
        $sentenciaSQL = $conexion->prepare("SELECT image FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($libro['image']) && ($libro['image'] != "image.jpg")) { //si no esta vacio o es image.jpg por defecto

            if (file_exists("../../img/" . $libro['image'])) { //si existe el archivo image en la ruta especficada

                unlink("../../img/" . $libro['image']); //borra el archivo de esa ruta

            }
        }
        //aca elimina todo el archivo id, nombre, nombre de la foto. Arriba elimina la foto de la base de datos.
        $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("Location:products.php");
        break;
}

//mostrar datos
$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); //el fetchall recoje todos los datos para mostrarlos en 
//la variable listaLibros. El FETCH_ASSOC genera una asociacion entre los elementos que vienen de la tabla y los
//nuevos registros

?>


<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Book Upload Form
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" placeholder="ID">
                </div>
                <div class="form-group">
                    <label for="txtName">Name of the Book:</label>
                    <input type="text" required class="form-control" name="txtName" id="txtName" value="<?php echo $txtName; ?>" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="txtImage">Image:</label>

                    <br>

                    <?php if ($txtImage != "") { ?>

                        <img class="img-tumbnail rounded" src="../../img/<?php echo $txtImage;  ?>" width="50" alt="">
                        <br>

                    <?php } ?>

                    <input type="file" class="form-control" name="txtImage" id="txtImage" placeholder="Image">
                </div>
                <div>
                    <button type="submit" name="action" <?php echo ($action == "select") ? "disabled" : "" ?> value="add" class="btn btn-outline-success">Add</button>
                    <button type="submit" name="action" <?php echo ($action !== "select") ? "disabled" : "" ?> value="modify" class="btn btn-outline-warning ">Modify</button>
                    <button type="submit" name="action" <?php echo ($action !== "select") ? "disabled" : "" ?> value="cancel" class="btn btn-outline-info ">Cancel</button>
                </div>
            </form>

        </div>

    </div>

</div>

<div class="col-md-7">

    <table class="table table-bordered table-info">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>

            </tr>
        </thead>

        <tbody>

            <?php foreach ($listaLibros as $libro) {  ?>
                <tr>
                    <td> <?php echo $libro['id'];  ?> </td>
                    <td> <?php echo $libro['name'];  ?></td>
                    <td>
                        <img class="img-tumbnail rounded" src="../../img/<?php echo $libro['image'];  ?>" width="50" alt="">
                    </td>
                    <td>
                        <form method="post">

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id'];  ?>" class="form-control form-control-sm">
                            <button type="submit" name="action" value="select" class="btn btn-outline-primary btn-sm">Select</button>
                            <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm">Delete</button>

                        </form>
                    </td>
                </tr>
            <?php    }   ?>

        </tbody>

    </table>

</div>


<?php include('../template/footer.php')      ?>