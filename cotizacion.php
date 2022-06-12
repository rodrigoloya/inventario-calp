<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=900, initial-scale=1.0">
    <title>Negocio</title>
    <link rel="stylesheet" href="css/main.css">

    <script > 
        window.onload = ()=>{
            //funcion para pasar la fecha del cliente al componente PHP
            const fecha = document.getElementById("fecha").value = new Date().toISOString();
             
        }
    </script>
</head>

<body>
    <div class="layout">

        <header>
            <nav class="menu">
                <ul class="menu-content">
                    <li class="menu-item"><a href="./index.html">Negocio</a></li>
                    <li class="menu-item"><a href="./catalogo.php">Catálogo</a> </li>
                    <li class="menu-item"><a href="./galeria.html">Galería</a> </li>
                    <li class="menu-item"><a href="./cotizacion.php">Cotización</a></li>
                    <li class="menu-item"><a href="./contacto.html">Contacto</a></li>
                    <li class="menu-item"><a href="./admin/login.html">Administración</a></li>
                </ul>
            </nav>
        </header>

        <?php
        
        //Obtener las variables desde el componente
        $nombre =   "";
        $email =    "";
        $edad=      "";
        $solicitud ="";
        $formStatus="";
        if(isset($_GET["f"])){
            try {
                $nombre =   $_GET['nombre'];
                $email =    $_GET['email'];
                $edad=      $_GET['edad'];
                $solicitud =$_GET['sol'];
                $formStatus=$_GET["f"];
            } catch(Exception $e) {
                echo $e->getMessage();
            }           
        
        }
        ?>
        <div class="content">
            <!--
o Título de la página con la etiqueta H2
o Un texto contenido en un párrafo, el cual indique la finalidad del
formulario.
o El formulario debe contar con los siguientes campos para ingreso de
información.
▪ Nombre completo.
▪ Edad.
▪ Correo electrónico.
▪ Entrada tipo área de texto para ingresar la solicitud.
▪ Agregar los botones para cancelar y enviar formulario.
Nota. Para los inputs debes usar los atributos de HTML5 para
diferenciar los campos tipo texto, tipo entero o tipo correo
electrónico.
- La página de contacto d-->
            <h2>Solicitud de Cotización</h2>
            <p class="formulario-cotizacion">
                Favor de llenar el siguiente formulario para solicitar una cotización por correo electrónico
            </p>
            <div class="formulario-cotizacion">
            <?php
                    if($formStatus == "success"){
                        print ("<h3 class='success'>Envio del formulario fue exitoso.</h3>");
                    }
                    elseif($formStatus == "char"){
                        print ("<h3 class='error'>El nombre debe contener al menos 3 letras</h3>");
                    }
                    elseif($formStatus == "email"){
                        print ("<h3 class='error'>El email es invalido, verifique.</h3>");
                    }
                    elseif($formStatus == "edad"){
                        print ("<h3 class='error'>La edad debe ser mínimo una edad de 18 años (mayores de edad) y máximo de 60 años </h3>");
                    }
                    elseif($formStatus == "solicitud"){
                        print ("<h3 class='error'>La solicitud es requerida con minimo 10 caracteres. Verifique</h3>");
                    }
                    elseif($formStatus == "error"){
                        print ("<h3 class='error'>Ocurrio un error al enviar el formulario</h3>");
                    }
                     
                    
                ?>
                <form action="cotizacion.component.php" method="post">
                    <span class="requerido">*</span> <span>Nombre completo:</span>
                    <?php echo '<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="'.$nombre.'">' ?>
                    <span class="requerido">*</span> <span>Edad:</span>
                    <?php echo '<input type="number" name="edad" id="edad" placeholder="Edad" value="'.$edad.'">' ?>
                    <br>
                    <span class="requerido">*</span> <span>Email:</span>
                    <?php echo '<input type="email" name="email" id="email" placeholder="your@email.com" value="'.$email.'">' ?>
                    <br>
                    <span class="requerido">*</span> <span>Detalles de la solicitud:</span>
                    <br>
                    <?php echo '<textarea name="solicitud" id="solicitud" cols="60" rows="6">'.$solicitud.'</textarea>' ?>
                    <br>
                    <input type="hidden" name="fecha" id="fecha">
                    <button id="cancelar" type="reset">Cancelar</button>
                      
                    <button type="submit" name="enviar" id="enviar">Enviar Solicitud</button>
                </form>
               
            </div>

        </div>

        <footer class="footer">
            <div class="footer-content">
                <p>Carlos Rodrigo Loya Piñera</p>
                <p>PW1</p>
                <p>Mayo 2022</p>
            </div>
        </footer>
    </div>
</body>

</html>