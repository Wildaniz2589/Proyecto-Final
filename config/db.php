<?php 
$host = "localhost";
$user = "root";
$password = "";
$database = "vivero";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer conjunto de caracteres a UTF-8
$conn->set_charset("utf8");
?>