<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $stmt = $conn->prepare("INSERT INTO plantas (nombre, precio, stock, id_categoria) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id_categoria);
    
    if ($stmt->execute()) {
        header("Location: ../views/plantas_listar.php");
    } else {
        echo "Error al guardar planta: " . $conn->error;
    }
}
?>