<?php
if(isset($_POST)){
    
    //conexion a la base de datos
    require_once 'includes/conexion.php';
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
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
    
    if(count($errores) == 0){
        $sql = "INSERT INTO categorias VALUE(null,'$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
}
header("Location: index.php");