<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "UPDATE plantas SET nombre = ?, precio = ?, stock = ?, id_categoria = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdiii", $nombre, $precio, $stock, $id_categoria, $id);

    if ($stmt->execute()) {
        header("Location: ../views/plantas_listar.php");
    } else {
        echo "❌ Error al actualizar la planta: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../views/plantas_listar.php");
}