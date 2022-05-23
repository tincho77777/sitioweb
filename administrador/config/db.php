<?php

$host = "localhost";
$database = "sitio_web";
$user = "root";
$password = "root";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    
} catch (Exception $e) {
    echo $e->getMessage();
}

?>