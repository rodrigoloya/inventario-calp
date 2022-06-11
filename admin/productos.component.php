<?php

use Producto as GlobalProducto;

    include_once '../includes/conexion.php';

//Verificamos que se haya hecho un post
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //obtenemos las variables del request
    $nombre =       $_POST['nombre'];
    $clave =        $_POST['clave'];
    $precio =       $_POST['precio'];
    $idProducto =   $_POST['idProducto'];
    $presentacion =   $_POST['presentacion'];
    $formSubmit =   $_POST['btnSubmit'];

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

function getAllProductos(){
    $conn = getConn();
    $lstProductos = array();
    $query = mysqli_query($conn, "SELECT * FROM producto");
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
    $query->close();
    return $lstProductos;
}

function agreagarProducto($producto){
    
    $query = "INSERT INTO producto (Clave, Nombre, Descripcion, Precio, Presentacion) VALUES (
         '$producto->clave'
        ,'$producto->nombre'
        ,'$producto->descripcion'
        ,$producto->precio
        ,'$producto->presentacion'
      
    )";
    $conn = getConn();

    $result =  $conn->query($query);

    $conn->close();

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