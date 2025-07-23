<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO plantas (nombre, precio, stock, id_categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id_categoria);

    if ($stmt->execute()) {
        header("Location: ../views/plantas_listar.php");
    } else {
        echo "❌ Error al guardar la planta: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../views/plantas_listar.php");
}
?>