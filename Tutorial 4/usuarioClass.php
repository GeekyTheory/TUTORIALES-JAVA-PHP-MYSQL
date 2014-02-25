<?php
class Usuarios{

    public $id_user = 0 ;
    //Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma. 
    function conectarBD(){ 
            $server = "localhost";
            $usuario = "root";
            $pass = "";
            $BD = "GeekyTheoryBD";
            //variable que guarda la conexión de la base de datos
            $conexion = mysqli_connect($server, $usuario, $pass, $BD); 
            //Comprobamos si la conexión ha tenido exito
            if(!$conexion){ 
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
            if(!$close){  
               echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; 
            }    
            //devuelve el estado del cierre de conexión
            return $close;         
    }

    //Devuelve un array multidimensional con el resultado de la consulta
    function getArraySQL($sql){
        //Creamos la conexión
        $conexion = $this->conectarBD();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die();

        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
        while($row = mysqli_fetch_array($result))
        {   
            //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
            $rawdata[$i] = $row;
            $i++;
        }
        //Cerramos la base de datos
        $this->desconectarBD($conexion);
        //devolvemos rawdata
        return $rawdata;
    }
    //inserta en la base de datos un nuevo registro en la tabla usuarios
    function createUser($nombre,$apellidos,$email){
        //creamos la conexión
        $conexion = $this->conectarBD();
        //Escribimos la sentencia sql necesaria respetando los tipos de datos
        $sql = "insert into usuarios (nombre,apellidos,email) 
        values ('".$nombre."','".$apellidos."','".$email."')";
        //hacemos la consulta y la comprobamos 
        $consulta = mysqli_query($conexion,$sql);
        if(!$consulta){
            echo "No se ha podido insertar una nueva Medalla en la base de datos<br><br>".mysqli_error($conexion);
        }
        //Desconectamos la base de datos
        $this->desconectarBD($conexion);
        //devolvemos el resultado de la consulta (true o false)
        return $consulta;
    }
    //obtiene toda la informacion de la base de datos
    function getAllInfo(){
        //Creamos la consulta
        $sql = "SELECT * FROM usuarios;";
        //obtenemos el array con toda la información
        return $this->getArraySQL($sql);
    }
    //obtiene el nombre del usuario cuyo ID user es el que se le asigna al objeto de la clase
    function getNombre(){
        //Creamos la consulta
        $sql = "SELECT nombre FROM usuarios WHERE id_user = ".$this->id_user.";";
        //obtenemos el array
        $data = $this->getArraySQL($sql);
        //obtenemos el primer elemento, ya que así no tenemos que extraerlo posteriormente
        return $data[0][0];
    }
    //obtiene los apellidos del usuario cuyo ID user es el que se le asigna al objeto de la clase
    function getApellidos(){
        //Creamos la consulta
        $sql = "SELECT apellidos FROM usuarios WHERE id_user = ".$this->id_user.";";
        //obtenemos el array
        $data = $this->getArraySQL($sql);
        //obtenemos el primer elemento, ya que así no tenemos que extraerlo posteriormente
        return $data[0][0];
    }
    //obtiene el mail del usuario cuyo ID user es el que se le asigna al objeto de la clase
    function getEmail(){
        //Creamos la consulta
        $sql = "SELECT email FROM usuarios WHERE id_user = ".$this->id_user.";";
        //obtenemos el array
        $data = $this->getArraySQL($sql);
        //obtenemos el primer elemento, ya que así no tenemos que extraerlo posteriormente
        return $data[0][0];
    }
}

//Para hacer un ejemplo de funcionamiento vamos a realizar los siguientes pasos:
//
//1º Vamos a crear un objeto de la clase Usuarios
//2º Vamos a crear un nuevo usuario en la base de datos
//3º Vamos a obtener su Nombre, Apellido y email del usuario que acabamos de insertar en la base de datos

//--Creamos un objeto de la clase Usuarios
$userObject = new Usuarios();
//Insertamos un nuevo usuario en la base de datos
$userObject->createUser("Alejandro","Esquiva","alejandro@geekytheory.com");
//Obtenemos los datos del usuario que acabamos de mostrar, como es el primer
//elemento de la base de datos vamos a suponer que tiene como ID el número 1
//En caso de que no fuese así deberiamos crearnos una función para obtener 
//el último id, esta función la dejo como ejercicio para aquellos que quiera practicar
$userObject->id_user=1;
//Obtenemos el nombre y lo mostramos por pantalla
echo $userObject->getNombre()."<br>";
//Obtenemos los apellidos y lo mostramos por pantalla
echo $userObject->getApellidos()."<br>";
//Obtenemos el nombre y lo mostramos por pantalla
echo $userObject->getEmail()."<br>";
?>