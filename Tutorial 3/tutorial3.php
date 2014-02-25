<?php
/**
*Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma. 
*/
function conectarBD(){ 
        $server = "localhost";
        $usuario = "root";
        $pass = "";
        $BD = "GeekyTheoryBD";
        //variable que guarda la conexión de la base de datos
        $conexion = mysqli_connect($server, $usuario, $pass, $BD); 
        //Comprobamos si la conexión ha tenido exito
        if($conexion){ 
           echo 'La conexion de la base de datos se ha hecho satisfactoriamente<br>'; 
        }else{ 
           echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>'; 
        } 
        //devolvemos el objeto de conexión para usarlo en las consultas  
        return $conexion; 
} 

/*Desconectar la conexion a la base de datos*/
function desconectarBD($conexion){
        //Cierra la conexión y guarda el estado de la operación en una variable
        $close = mysqli_close($conexion); 
        //Comprobamos si se ha cerrado la conexión correctamente
        if($close){ 
           echo 'La desconexion de la base de datos se ha hecho satisfactoriamente<br>'; 
        }else{ 
           echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; 
        }    
        //devuelve el estado del cierre de conexión
        return $close;         
}