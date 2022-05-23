<?php   include('template/header.php');      ?>

<?php   $userName = $_SESSION['userName'];      ?>





<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Welcome <?php echo $userName; ?> </h1>
        <p class="lead">Let's manage our books</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="section/products.php" role="button">Manage books</a>
        </p>
    </div>
</div>



