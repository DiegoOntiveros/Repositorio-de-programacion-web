<?php 

include "UserModel.php";

if (isset($_POST['action']) && $_POST['action'] == "update_user") {

    $id = $_POST['idusuario'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];    

    $user = new UpdateUsers();
    $user->update($id, $usuario, $correo, $contraseña);
} 

class UpdateUsers {
    private $User;

    public function __construct() {
        $this->User = new UserModel();
    }

    public function update($id, $name, $email, $password) { 
        if ($this->User->update($name, $email, $password, $id)) {
            header('Location: ../views/inicio.php?status=ok');
            echo "error de datos";
        } else {
            header('Location: ../views/inicio.php?status=error');
        }
    }
}


?>
