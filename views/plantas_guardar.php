<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$id_categoria = $_POST['id_categoria'];

$sql = "INSERT INTO plantas (nombre, precio, stock, id_categoria) 
        VALUES ('$nombre', $precio, $stock, $id_categoria)";

if ($conn->query($sql)) {
    header("Location: ../views/plantas_listar.php");
} else {
    echo "Error al guardar: " . $conn->error;
}
?>