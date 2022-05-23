<?php include("./template/header.php");  ?>

<?php 

include("administrador/config/db.php"); 

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($listaLibros as $libro){  ?>

<div class="col-md-3">
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $libro['image']  ?>" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $libro['name'];  ?></h4>
        </div>
    </div>
</div>

<?php }  ?>









<?php include("./template/footer.php");  ?>