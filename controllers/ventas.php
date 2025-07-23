<?php
require_once '../../config/db.php'; // Ajusta la ruta si es necesario

function obtenerHistorialVentas() {
    global $conn;

    $sql = "SELECT ventas.id, ventas.fecha, usuarios.nombre AS cliente, ventas.total
            FROM ventas
            JOIN usuarios ON ventas.id_usuario = usuarios.id
            ORDER BY ventas.fecha DESC";

    $resultado = $conn->query($sql);
    $ventas = [];

    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $ventas[] = $fila;
        }
    }

    return $ventas;
}
?>