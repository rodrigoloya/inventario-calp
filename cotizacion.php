<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=900, initial-scale=1.0">
    <title>Negocio</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="layout">

        <header>
            <nav class="menu">
                <ul class="menu-content">
                    <li class="menu-item"><a href="./index.html">Negocio</a></li>
                    <li class="menu-item"><a href="./catalogo.html">Catálogo</a> </li>
                    <li class="menu-item"><a href="./cotizacion.php">Cotización</a></li>
                    <li class="menu-item"><a href="./contacto.html">Contacto</a></li>
                    <li class="menu-item"><a href="./admin/login.html">Administración</a></li>
                </ul>
            </nav>
        </header>

        <?php
        
        //Obtener las variables desde el componente
        if(isset($_GET["f"])){
            $nombre =   $_GET['nombre'];
            $email =    $_GET['email'];
            $edad=      $_GET['edad'];
            $solicitud =$_GET['solicitud'];
            $formStatus=$_GET["f"];
        
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
                <form action="cotizacion.component.php" method="post">
                    <span class="requerido">*</span> <span>Nombre completo:</span>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value=<?php $nombre ?>>
                    <span class="requerido">*</span> <span>Edad:</span>
                    <input type="number" name="edad" id="edad" placeholder="Edad">
                    <br>
                    <span class="requerido">*</span> <span>Email:</span>
                    <input type="email" name="email" id="email" placeholder="your@email.com">
                    <br>
                    <span class="requerido">*</span> <span>Detalles de la solicitud:</span>
                    <br>
                    <textarea name="solicitud" id="solicitud" cols="60" rows="6"></textarea>
                    <br>
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