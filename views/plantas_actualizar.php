<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$id_categoria = $_POST['id_categoria'];

$sql = "UPDATE plantas SET 
            nombre = '$nombre',
            precio = $precio,
            stock = $stock,
            id_categoria = $id_categoria
        WHERE id = $id";

if ($conn->query($sql)) {
    header("Location: ../views/plantas_listar.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>