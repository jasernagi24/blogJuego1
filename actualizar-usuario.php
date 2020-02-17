<?php


if(isset($_POST)){
    //conexion a la base de datos
    require_once 'includes/conexion.php';


    //Recoger los valores del formulario de actualizacion -- barra lateral
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
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
    
    //Insertar usuario en la base de datos
    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
        
        //comprobar si el email existe
        $sql = "SELECT id, email FROM usuarios WHERE email =  '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
        //actualizar usuario en la tabla usuarios de la bdd
        $usuario = $_SESSION['usuario'];
        $sql = "UPDATE usuarios SET ".
                "nombre = '$nombre', ".
                "apellido = '$apellido', ".
                "email = '$email' ".
                "WHERE id = ".$usuario['id'];
        $guardar = mysqli_query($db, $sql);
        
        if($guardar){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellido'] = $apellido;
            $_SESSION['usuario']['email'] = $email;
            
            $_SESSION['completado'] = "La actualizacion se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al actualizar el usuario!!";
        }
    }else{
            $_SESSION['errores']['general'] = "Este email ya pertenece a otro usuario!!";
    }
    }else{
    $_SESSION['errores'] = $errores;
    }
}
header('Location: mis-datos.php');