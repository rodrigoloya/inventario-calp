<html>

    <head>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <?php

        /*
    Genera la página PHP “Login.php” que reciba los datos del formulario, valide la
    información, permitiendo el ingreso al área administrativa o generando mensaje de
    error. Para realizar esto, utiliza la siguiente tabla que contiene la información de los
    usuarios registrados:

    Usuario         Contraseña

    Admin01         2022admin

    Gerente         2022grete

    Sistema         2022stema

    */

        $usuario_bd = array(
            "admin01" => "2022admin",
            "gerente" => "2022grete",
            "sistema" => "2022stema"
        );

        $usuarioValido = false;
        $usuario =  $_POST["usuario"];
        $password = $_POST["password"];
        $msgError = "";

        if ($usuario === "" || is_null($usuario)) {
            $msgError = "El usuario es requerido!";
        } elseif ($password === "" || is_null($password)) {
            $msgError = ("La contraseña es requerida!");
        } else {
            // Convertimos a minusculas el nombre de usuario
            $usuario = strtolower($usuario);

            if ($usuario_bd[$usuario] === $password) {
                //print("login correcto");
                //asignamos TRUE a la variable que usaremos para verificar el sitio
                $usuarioValido = true;
            } else {
                $msgError = "<p>Usuario o contraseña incorrecta. Verifique</p>";
            }
        }

        if ($usuarioValido) {
            print("<h2>Credenciales aceptadas para usuario: $usuario</h2>");
            echo "<br/>";
            echo "<a  class='btn-continuar'  href='productos.html' >Continuar</a>";
        } else {
            print($msgError);
            echo "<br/>";
            echo "<a class='btn-continuar'  href='login.html' >Login</a>";
        }
        ?>

</body>

</html>