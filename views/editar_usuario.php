<?php 
include "../php/UserModel.php";

if (!isset($_GET['idusuario'])) {
    die("ID de usuario no especificado.");
}

$idusuario = (int)$_GET['idusuario'];
$model = new UserModel();

$usuarios = $model->get();
$user = null;
foreach ($usuarios as $u) {
    if ($u['idusuario'] == $idusuario) {
        $user = $u;
        break;
    }
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet"  href="../CSS/formulario.css">
	<title>Editar datos</title>

</head>
<body>
	<form method="post" action="../php/Updateusers.php">
		<input type="hidden" name="idusuario" value="<?= $user['idusuario'] ?>">
		<h1>Editar datos</h1>
		<br>
		<h2>Escriba sus datos</h2>
		<br>
		<label>Nombre:</label>
<input type="text" name="usuario" value="<?= $user['usuario'] ?>">
		<br>
		<br>
		<label>Correo:</label>
<input type="text" name="correo" value="<?= $user['correo'] ?>">
		<br>
		<br>
		<label>Contraseña:</label>
		<input type="text" name="contraseña">
		<br>
		<br>
		<input type="hidden" name="action" value="update_user">
    <button type="submit">Enviar</button>
	</form>

</body>
</html>