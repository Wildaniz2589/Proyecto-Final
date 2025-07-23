<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $planta_id = intval($_POST['planta_id']);
    $cantidad = intval($_POST['cantidad']);
    $usuario_id = $_SESSION['usuario']['id'];

    // Obtener precio de la planta
    $sql_planta = "SELECT precio, stock FROM plantas WHERE id = $planta_id";
    $resultado_planta = $conn->query($sql_planta);

    if ($resultado_planta && $resultado_planta->num_rows === 1) {
        $planta = $resultado_planta->fetch_assoc();
        $precio = $planta['precio'];
        $stock_disponible = $planta['stock'];

        // Verificar stock
        if ($cantidad > $stock_disponible) {
            echo "Error: No hay suficiente stock disponible.";
            exit();
        }

        $total = $precio * $cantidad;

        // Iniciar transacción
        $conn->begin_transaction();

        try {
            // Insertar venta
            $sql_venta = "INSERT INTO ventas (fecha, id_usuario, total) VALUES (NOW(), $usuario_id, $total)";
            $conn->query($sql_venta);
            $venta_id = $conn->insert_id;

            // Insertar detalle de venta
            $sql_detalle = "INSERT INTO venta_detalle (id_venta, id_planta, cantidad, precio_unitario)
                            VALUES ($venta_id, $planta_id, $cantidad, $precio)";
            $conn->query($sql_detalle);

            // Actualizar stock
            $nuevo_stock = $stock_disponible - $cantidad;
            $sql_update = "UPDATE plantas SET stock = $nuevo_stock WHERE id = $planta_id";
            $conn->query($sql_update);

            // Confirmar transacción
            $conn->commit();

            header("Location: ../views/ventas/ventas_historial.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error al registrar la venta: " . $e->getMessage();
        }
    } else {
        echo "Error: Planta no encontrada.";
    }
} else {
    echo "Acceso no permitido.";
}
?>