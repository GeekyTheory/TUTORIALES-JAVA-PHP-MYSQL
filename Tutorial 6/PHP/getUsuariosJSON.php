<?php
/**
*Autor: Alejandro Esquiva Rodríguez (@alex_esquiva)
*Desarrollado para Geeky Theory
*
*Este archivo mostrará un JSON para que la aplicación JAVA lo lea
*/
//--Incluimos el archivo en usuarioClass.php
require_once("usuarioClass.php"); 
//--Creamos una instancia de la calse usuarios
$userObject = new Usuarios();
//--Obtenemos un array multidimensional con todos los usuarios registrados
$users = $userObject->getAllInfo();
//Codificamos el array multidimensional y lo mostramos en pantalla
echo json_encode($users);    
?>