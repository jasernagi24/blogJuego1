<?php

// iniciar la sesion y la conexion a la red
require_once 'includes/conexion.php';

// recoger datos del formulario
if (isset($_POST)) {
    
    //borrar error antiguo
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }
    
    //recoger datos 
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //consulta para comprobar las credenciales
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);

        //comprobar la contraseña/cifrar
        $verify = password_verify($password, $usuario['password']);
        if ($verify) {
            //utlizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

        } else {
            // si algo falla enviar una sesion con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    } else {
        //mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
    }
}
header('Location: index.php');
