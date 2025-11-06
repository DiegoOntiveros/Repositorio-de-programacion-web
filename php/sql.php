<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$usuario = "pepe";
$clave = "12345";
$baseDeDatos = "usuarios";

$conn = new mysqli($host, $usuario, $clave, $baseDeDatos);

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
} else {
    echo " Conexión exitosa a la base de datos!";
}

$conn->close();
?>