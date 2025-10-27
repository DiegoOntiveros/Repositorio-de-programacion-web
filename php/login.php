<?php 

$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Contrasena = $_POST['Contraseña']; 
$Telefono = $_POST['Telefono'];

$NombreValido = "Pepe";
$ContrasenaValida = "2005";
$CorreoValido = "pepe.com";

if ($Nombre === $NombreValido && $Contrasena === $ContrasenaValida && $Correo === $CorreoValido) {
    header("Location: ../views/barra.html");
    exit();
} else {
    header("Location: ../views/login.html");
    exit();
}

?>
