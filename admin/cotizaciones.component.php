<?php
    include_once '../includes/conexion.php';

    class Cotizacion{

        public $idCotizacion;
        public $nombre;
        public $edad;
        public $email;
        public $detalle;
        public $fechaAlta;
        public $fechaModificacion;
    
        function __construct(){ }
    }

    //Funcion que regresa un arreglo de tipo Cotizacion, con todos los elementos activos de la tabla cotizacion
function getAllCotizaciones(){

    //Obtenemos el objeto de conexion MySQL
    $conn = getConn();

    //creamos un arreglo vacio
    $lstCotizacion = array();

    //obtenemos un objeto mysqli_result que contiene el comando SQL para ejecutar en la BD
    $query = mysqli_query($conn, "SELECT * FROM cotizacion ");
   
    //Verificamos que tenga registros la consulta, de ser asi hidratamos el arreglo
    if(mysqli_num_rows($query)> 0){
        $i=0;
        while($row = mysqli_fetch_assoc($query)){
            $lstCotizacion[$i] = new Cotizacion();
            $lstCotizacion[$i]->idCotizacion = $row["IdCotizacion"];
            $lstCotizacion[$i]->email = $row["Email"];
            $lstCotizacion[$i]->nombre = $row["Nombre"];           
            $lstCotizacion[$i]->detalle = $row["Detalle"];      
            $lstCotizacion[$i]->edad = $row["Edad"];              
            $lstCotizacion[$i]->fechaAlta = $row["FechaAlta"];
            $lstCotizacion[$i]->FechaModificacion = $row["FechaModificacion"];     
            
            //siguiente registro
            $i++;
        }
    }

    //Cerramos la conexion a la base de datos para liberar recursos.
    $query->close();

    //devolvemos el arreglo
    return $lstCotizacion;
}

?>