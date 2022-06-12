<?php   
    include_once './includes/conexion.php';


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


//Verificamos que se haya hecho un post
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //obtenemos las variables del request
    $nombre =       $_POST['nombre'];
    $email =        $_POST['email'];
    $edad=          $_POST['edad'];
    $solicitud =    $_POST['solicitud'];
    $fechaCliente =    $_POST['fecha'];
    $formSubmit =   $_POST['enviar'];


    function checkemail($str) {
        try {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;

        } catch (Exception $e) {
            echo $e -> getMessage();
        }
    }

    if(!isset($formSubmit)){
        header('Location: ./cotizacion.php?f=form');
        exit();
    }

    //Revisar que cuente con caracteres validos el nombre
    //if(!preg_match("/^[a-zA-Z]*$/", $nombre )){
    if(strlen($nombre) <3 ){
        header("Location: ./cotizacion.php?f=char&nombre=$nombre&email=$email&edad=$edad&sol=$solicitud");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        //Verificamos que sea una cuenta de email valida
        header("Location: ./cotizacion.php?f=email&nombre=$nombre&email=$email&edad=$edad&sol=$solicitud");
        exit();
    }
    elseif(!filter_var($edad, FILTER_VALIDATE_INT) || ($edad < 18 || $edad >60) )  { 
        // Verificamos que la edad sea admitida por el sistema
        header("Location: ./cotizacion.php?f=edad&nombre=$nombre&email=$email&edad=$edad&sol=$solicitud");
        exit();
    }
    elseif(strlen($solicitud) < 10 )  { 
        //Verificamos que la longitud de la solicitud sea suficiente
        header("Location: ./cotizacion.php?f=solicitud&nombre=$nombre&email=$email&edad=$edad&sol=$solicitud");
        exit();
    }
    else{
        //Enviamos un attributo de success cuando paso todas las validaciones.

        //intetamos insertar en la base de datos
       

        try {
            //verificamos que la fecha del cliente este en formato correcto de lo contrario insertamos la fecha del servidor
            
            //$date = date_create_from_format("m-d-Y", $fechaCliente)->format('Y-m-d H:i:s');
            $date = date('Y-m-d H:i:s', strtotime($fechaCliente));
            
        } catch (\Throwable $th) {
            $date = date('Y-m-d H:i:s');
        }

        $c = new Cotizacion();
        $c->nombre      = $nombre ;
        $c->edad        = $edad ;
        $c->email       = $email ;
        $c->detalle   = $solicitud ;
        $c->fechaAlta   = $date ;
         
       agregarCotizacion($c);
    }



}

function agregarCotizacion($cotizacion){

    //Construccion del query para insertar una fila en la tabla
    $query = "INSERT INTO cotizacion (Nombre, Edad, Email, Detalle, FechaAlta) VALUES (
        '$cotizacion->nombre'
       , $cotizacion->edad
       ,'$cotizacion->email'
       ,'$cotizacion->detalle'
       ,'$cotizacion->fechaAlta'     
   )";

   //Obtenemos el objeto de conexion
   $conn = getConn();

   //Ejecutamos el comando query (comando procedimental) que devuelve un booleano
   $result =  $conn->query($query);

   //Cerramos la conexion a la base de datos
   $conn->close();

   //Redirigimos la navegacion y enviamos un parametro en la url para indicar si el comando fue satisfactorio o no
    if($result === true){
       header('Location: ./cotizacion.php?f=success');
       exit();
    }
    else{
       header('Location: ./cotizacion.php?f=error');
       exit();
    }

}

?>