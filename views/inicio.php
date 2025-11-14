<?php 
	#Mostrar errores en php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); 

	#traer todos los usuarios
	include "../php/UsersController.php";
	$usersC = new UsersController();
	$all_users = $usersC->getAll();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<table>
		
		<tr>
			<th>
				ID
			</th>
			<th>
				Nombre
			</th>
			<th>
				Correo 
			</th>
			<th>
				Contraseña
			</th>
			<th>
				Acciones
			</th>
		</tr>

		<?php if( isset($all_users) && count($all_users) ): ?>
		<?php  foreach ($all_users as $user  ): ?>
		<tr>
			<td>
				<?= $user['idusuario'] ?>
			</td>
			<td>
				<?= $user['usuario'] ?>
			</td>
			<td>
				<?= $user['correo'] ?>
			</td>
			<td>
				<?= $user['contraseña'] ?>
			</td>
			<td>
				<a href="editar_usuario.php?idusuario=<?= $user['idusuario'] ?>">
   				 <button>Editar</button>
				</a>
				<button>
					Eliminar
				</button>
			</td>
		</tr>
		<?php  endforeach  ?>
		<?php  endif  ?>
	</table>

	<hr>

	<form method="post" action="../php/UsersController.php">
		
		<div>
			
			<label>
				Nombre
			</label>
			<input type="text" placeholder="write here" name="name">

		</div>

		<div>
			
			<label>
				Email
			</label>
			<input type="email" placeholder="write here" name="email">

		</div>

		<div>
			
			<label>
				Password
			</label>
			<input type="password" placeholder="write here" name="password">

		</div>

		<button type="submit">
			Guardar datos
		</button>

		<input type="hidden" name="action" value="create_user">

	</form>

</body>
</html>