<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

include "sql.php";

class UserModel{

	private $connection;

	public function __construct() {
	    $this->connection = new ConnectionController();
	}

	public function get()
	{	
		$conn = $this->connection->connect();

		$query = "select * from usuario"; 
		$prepared_query = $conn->prepare($query); 
		$prepared_query->execute();

		$results = $prepared_query->get_result();
		$users = $results->fetch_all(MYSQLI_ASSOC);

		return $users;
	}

	public function create($usuario, $correo, $contraseña)
	{

		$conn = $this->connection->connect();
 
		$query = "INSERT INTO usuario (usuario, correo, contraseña) VALUES (?,?,?)";

		$prepared_query = $conn->prepare($query);

		$prepared_query->bind_param('sss', $usuario, $correo, $contraseña);

		$prepared_query->execute();

		$results = $prepared_query->get_result();


		if (isset($results->errno)){
			return false;
		}else
			return true;
	}

	public function update($name, $email, $password, $id)
{
    $conn = $this->connection->connect();

	$query = "UPDATE usuario SET usuario = ?, correo = ?, contraseña = ? WHERE idusuario = ?";

    $prepared_query = $conn->prepare($query);

	$prepared_query->bind_param('sssi', $name, $email, $password, $id);

    $prepared_query->execute();

    if ($prepared_query->errno) {
        return false;
    } else {
        return true;
    }
}


	public function delete($id)
	{

		$conn = $this->connection->connect();
		$query = "delete FROM `users` WHERE id = ?";

		$prepared_query = $conn->prepare($query);

		$prepared_query->bind_param('i',$id);

		$prepared_query->execute();

		$results = $prepared_query->get_result();

		if ($results->errno){
			return false;
		}else
			return true;
	}
}


?>