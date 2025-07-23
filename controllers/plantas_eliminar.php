<?php
session_start();
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['rol'], [1, 3])) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM plantas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../views/plantas_listar.php");
    } else {
        echo "❌ Error al eliminar la planta: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../views/plantas_listar.php");
}