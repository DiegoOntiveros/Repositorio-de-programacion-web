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

$correo = isset($_POST['Correo']) ? $_POST['Correo'] : '';
$contrasena = isset($_POST['Contraseña']) ? $_POST['Contraseña'] : '';

if (empty($correo) || empty($contrasena)) {
    echo "<script>
        alert('Por favor, completa todos los campos.');
        window.location.href='../views/iniciosesion.html';
    </script>";
    exit();
}

$sql = "SELECT * FROM usuario WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario_db = $resultado->fetch_assoc();
    
    if (password_verify($contrasena, $usuario_db['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario_db['idusuario'];
        $_SESSION['usuario_nombre'] = $usuario_db['usuario'];
        $_SESSION['usuario_correo'] = $usuario_db['correo'];
        
        echo "<script>
            alert('Bienvenido " . $usuario_db['usuario'] . "!');
            window.location.href='../views/barra.html';
        </script>";
    } else {
        echo "<script>
            alert('Contraseña incorrecta.');
            window.location.href='../views/iniciosesion.html';
        </script>";
    }
} else {
    echo "<script>
        alert('Usuario no encontrado. Regístrate primero.');
        window.location.href='../views/iniciosesion.html';
    </script>";
}

$stmt->close();
$conn->close();
?>