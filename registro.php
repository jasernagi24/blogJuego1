<?php


if(isset($_POST)){
    //conexion a la base de datos
    require_once 'includes/conexion.php';

    //iniciar sesion
    if(!isset($_SESSION)){
        session_start();
    }
    
    //Recoger los valores del formulario de registro -- barra lateral
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    //array errorres
    //validar nombre
    $errores = array();
    //validar los datos antes de guardarlos en la base de datos
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }  else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";    
    }
    //validar apellido
    //validar los datos antes de guardarlos en la base de datos
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validado = true;
    }  else {
        $apellido_validado = false;
        $errores['apellido'] = "El apellido no es valido";    
    }
    //validar email
    //validar los datos antes de guardarlos en la base de datos
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }  else {
        $email_validado = false;
        $errores['email'] = "El email no es valido";    
    }
    //validar password
    //validar los datos antes de guardarlos en la base de datos
    if(!empty($password)){
        $password_validado = true;
    }  else {
        $password_validado = false;
        $errores['password'] = "La contraseña esta vacia";    
    }
    
    //Insertar usuario en la base de datos
    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
        //cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        //insertar usuario en la tabla usuarios de la bdd
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "fallo al guardar el usuario!!";
        }
    }else{
    $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');

