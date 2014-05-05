<meta charset="utf-8"> 
<?php
/**
*Autor: Alejandro Esquiva Rodríguez (@alex_esquiva)
*Desarrollado para Geeky Theory
*
*Este archivo estará a la escucha de llamadas procedentes del cliente JAVA
*/
//--Incluimos el archivo en usuarioClass.php
require_once("usuarioClass.php"); 
//Comprobamos si hemos recibido alguna llamada por GET
if(isset($_GET["json"])){
	$json = $_GET["json"];
	$json = urldecode($json);
	$json = str_replace("\\", "",$json);
	$jsonencode = json_decode($json);
	
	//--Creamos un objeto de la clase usuarioClass
	$userObject = new Usuarios();
	//Insertamos un nuevo usuario en la base de datos
	$userObject->createUser($jsonencode[0]->nombre,$jsonencode[0]->apellidos,$jsonencode[0]->email);
}
?>