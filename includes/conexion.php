<?php

define('LHOST', 'localhost');
define('LUSER', 'root');
define('LPASS', '');
define('LPORT','3306');
define('LDB', 'chiringuito');

//Definimos las variables de entorno, para uso local y remoto
define('RHOST', 'containers-us-west-68.railway.app');
define('RUSER', 'root');
define('RPASS', '9jrP8S4ZAcJjAb9jE2YD');
define('RPORT','6333');
define('RDB', 'railway');


//Funcion que devuelve un objeto mysqli, necesario para ejecutar los commandos SQL
function getConn(){
    // Create connection
    $conn = new mysqli(RHOST, RUSER, RPASS, RDB, RPORT);

    // Validamos que la conexion se haya realizado
    if ($conn->connect_error) {
        //salimos del procedimiento lanzando un mensaje de error
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


/*echo "Connected successfully";

$query = mysqli_query($conn, "SELECT * FROM categoria");
$result = mysqli_fetch_all($query);

for($i = 0; $i< count( $result); $i++){
    echo "<pre>";
    print_r(  $result );
}

if(mysqli_num_rows($query) > 0){
    while($row =mysqli_fetch_assoc($query)){
        echo '<pre>';
        print_r($row);
    }

}
else{
    echo "No data found";
}
*/
?>