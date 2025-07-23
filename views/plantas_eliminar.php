<?php
session_start();
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['rol'], [1, 3])) {
    header("Location: ../views/dashboard.php");
    exit();
}

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM plantas WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: ../views/plantas_listar.php");
    } else {
        echo "❌ Error al eliminar la planta: " . $conn->error;
    }
} else {
    header("Location: ../views/plantas_listar.php");
}
?>