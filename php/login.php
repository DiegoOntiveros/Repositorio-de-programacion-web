<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = "localhost";   
$usuario = "pepe";
$clave = "12345";         
$baseDeDatos = "usuarios";

$conn = new mysqli($host, $usuario, $clave, $baseDeDatos);

if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

$nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
$correo = isset($_POST['Correo']) ? $_POST['Correo'] : '';
$contrasena = isset($_POST['Contraseña']) ? $_POST['Contraseña'] : '';

if (empty($nombre) || empty($correo) || empty($contrasena)) {
    echo "<script>
        alert('Por favor, completa todos los campos.');
        window.location.href='../views/login.html';
    </script>";
    exit();
}

$sql = "SELECT * FROM usuario WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>
        alert('Este correo ya está registrado. Inicia sesión. :(');
        window.location.href='../views/login.html';
    </script>";
    exit();
}

//encripta la contraseña en la base de datos.
$hash = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (usuario, correo, contraseña) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $hash);

if ($stmt->execute()) {
    echo "<script>
        alert('Registro hecho correctamente. Ahora inicia sesión. :D');
        window.location.href='../views/iniciosesion.html';
    </script>";
} else {
    echo "<script>
        alert('Error al registrar usuario: " . $conn->error . "');
        window.location.href='../views/login.html';
    </script>";
}

$stmt->close();
$conn->close();
?>