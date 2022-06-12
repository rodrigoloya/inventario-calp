<?php

use Producto as GlobalProducto;

    include_once '../includes/conexion.php';

//Verificamos que se haya hecho un post
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //obtenemos las variables del request
    $nombre =       mysqli_real_escape_string(getConn(),$_POST['nombre']);
    $clave =        mysqli_real_escape_string(getConn(),$_POST['clave']);
    $precio =       mysqli_real_escape_string(getConn(),$_POST['precio']);
    $idProducto =   mysqli_real_escape_string(getConn(),$_POST['idProducto']);
    $presentacion = mysqli_real_escape_string(getConn(),$_POST['presentacion']);
    $formSubmit =   mysqli_real_escape_string(getConn(),$_POST['btnSubmit']);

    function checkemail($str) {
        try {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;

        } catch (Exception $e) {
            echo $e -> getMessage();
        }
    }



    if(!isset($formSubmit)){
        header('Location: ./productos.php?f=form');
        exit();
    }

    if(strlen($nombre) === 0 ){
        header("Location: ./cotizacion.php?f=nombre");
        exit();
    }

    if(strlen($clave) === 0 ){
        header("Location: ./cotizacion.php?f=clave");
        exit();
    }

    //Validar que el precio sea un numero decimal
    $precio = filter_var($precio, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

   
    if($idProducto == null || strlen($idProducto) === 0){
        //Es un insert
        $p = new Producto();
        $p->nombre = $nombre;
        $p->clave = $clave;
        $p->precio = $precio;        
        $p->presentacion = $presentacion;        
        
        agreagarProducto($p);

    }
    else{
        //editar registro
        $p = new Producto();
        $p->idProducto = $idProducto;
        $p->nombre = $nombre;
        $p->clave = $clave;
        $p->precio = $precio;        
        $p->presentacion = $presentacion;        
        
        actualizarProducto($p);
    }


}
else{
    $queryReq = $_GET['request'];
    if($queryReq === "d"){
        //delete
        $id = $_GET['idproducto'];
        borrarProducto($id);
    }

}

//Clase para almacenar la informacion basica de un producto
class Producto {

    //Attributos de la clase
    public $idProducto;
    public $clave;
    public $nombre;
    public $descripcion;
    public $precio;    
    public $presentacion;
    public $tags;
    public $idCategoria;
    public $status;

    function __construct(){ }
}

//Funcion que regresa un arreglo de tipo Producto, con todos los elementos activos de la tabla producto
function getAllProductos(){

    //Obtenemos el objeto de conexion MySQL
    $conn = getConn();

    //creamos un arreglo vacio
    $lstProductos = array();

    //obtenemos un objeto mysqli_result que contiene el comando SQL para ejecutar en la BD
    $query = mysqli_query($conn, "SELECT * FROM producto WHERE IdStatusProducto IS NULL OR IdStatusProducto NOT IN (2)");
   
    //Verificamos que tenga registros la consulta, de ser asi hidratamos el arreglo
    if(mysqli_num_rows($query)> 0){
        $i=0;
        while($row = mysqli_fetch_assoc($query)){
            $lstProductos[$i] = new Producto();
            $lstProductos[$i]->idProducto = $row["IdProducto"];
            $lstProductos[$i]->clave = $row["Clave"];
            $lstProductos[$i]->nombre = $row["Nombre"];           
            $lstProductos[$i]->descripcion = $row["Descripcion"];      
            $lstProductos[$i]->precio = $row["Precio"];           
            $lstProductos[$i]->tags = $row["Tags"];         
            $lstProductos[$i]->presentacion = $row["Presentacion"];
            $lstProductos[$i]->idCategoria = $row["IdCategoria"];     
            $lstProductos[$i]->status = $row["IdStatusProducto"];       
            
            //siguiente registro
            $i++;
        }
    }

    //Cerramos la conexion a la base de datos para liberar recursos.
    $query->close();

    //devolvemos el arreglo
    return $lstProductos;
}

//Funcion para insertar un registro en la tabla producto
function agreagarProducto($producto){
    
    //Construccion del query para insertar una fila en la tabla
    $query = "INSERT INTO producto (Clave, Nombre, Descripcion, Precio, Presentacion) VALUES (
         '$producto->clave'
        ,'$producto->nombre'
        ,'$producto->descripcion'
        ,$producto->precio
        ,'$producto->presentacion'
      
    )";

    //Obtenemos el objeto de conexion
    $conn = getConn();

    //Ejecutamos el comando query (comando procedimental) que devuelve un booleano
    $result =  $conn->query($query);

    //Cerramos la conexion a la base de datos
    $conn->close();

    //Redirigimos la navegacion y enviamos un parametro en la url para indicar si el comando fue satisfactorio o no
     if($result === true){
        header('Location: ./productos.php?f=success');
        exit();
     }
     else{
        header('Location: ./productos.php?f=error');
        exit();
     }
}

//Funcion que modifica un registro de la tabla producto por su llave primaria.
function actualizarProducto($producto)
{
    //Construccion del query SQL UPDATE
    $query = "UPDATE producto SET 
        Clave = '$producto->clave', Nombre='$producto->nombre', Descripcion='$producto->descripcion',
         Precio=$producto->precio, Presentacion='$producto->presentacion' WHERE IdProducto = $producto->idProducto";
      
      //Obtenemos el objeto mysqli conexion
   $conn = getConn();

   //Ejecutamos el comando SQL en la base de datos, y almacenamos la respuesta TRUE or FALSE
   $result =  $conn->query($query);

   //Cerramos la conexion a la BD
   $conn->close();

   //Redirigimos la navegacion enviando un parametro de status de la operacion
    if($result === true){
       header('Location: ./productos.php?f=success');
       exit();
    }
    else{
        header('Location: ./productos.php?f=error');
       exit();
    }
}

//Funcion para dar de baja logica un producto de la tabla producto
function borrarProducto($idProducto){

    //Construccion del commando SQL update donde actualizaremos la columna IdStatusProducto
    //al valor 2 que representa Inactivo
    $query = "UPDATE producto SET 
        IdStatusProducto = 2  WHERE IdProducto = $idProducto";

        //Obtenemos el objeto de conexion
   $conn = getConn();

   //Ejecutamos el comando SQL
   $result =  $conn->query($query);

   //Cerramos la conexion a la BD
   $conn->close();
 
   //Redirigimos la navegacion enviando un parametro de resultado de la operacion
    if($result === true){
       header('Location: ./productos.php?f=success');
       exit();
    }
    else{
       header('Location: ./productos.php?f=error');
       exit();
    } 
}

?>