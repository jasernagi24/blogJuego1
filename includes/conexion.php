<?php

/* Conexion a la base de datos */
$servidor = "localhost";
$usuario = "root";
$password = "";
$basededatos = "mysql_php";
$db = mysqli_connect($servidor, $usuario, $password, $basededatos, "3308", "");

mysqli_query($db, "SET NAMES 'utf8'");

//iniciar session
if (!isset($_SESSION)) {
    session_start();
}