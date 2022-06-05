
<?php   

//Verificamos que se haya hecho un post
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //obtenemos las variables del request
    $nombre =       $_POST['nombre'];
    $email =        $_POST['email'];
    $edad=          $_POST['edad'];
    $solicitud =    $_POST['solicitud'];
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
        header('Location: ./cotizacion.php?f=success');
        exit();
    }



}

?>