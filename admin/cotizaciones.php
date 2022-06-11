<?php
    include './cotizaciones.component.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=900, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="layout">

        <header>
            <nav class="menu">
                <ul class="menu-content">
                    <li class="menu-item"><a href="../admin/productos.php" >Productos por Vender</a> </li>
                    <li class="menu-item"><a href="../admin/cotizaciones.html" >Consultar Solicitudes</a></li>
                    <li class="menu-item"><a href="../index.html">Cerrar Session</a></li>
                </ul>
            </nav>
        </header>

        <div class="content">
<!--
Una tabla con 4 columnas que tendrán la siguiente información (debe
contener al menos 2 solicitudes).
▪ Nombre completo
▪ Correo
▪ Fecha de solicitud
▪ Descripción de la solicitud
-->
        <h2>Consulta de Solicitudes</h2>
        <div class="tabla-solicitudes">
            <div class="solicitud-encabezado">Nombre Completo</div>
            <div class="solicitud-encabezado">Correo</div>
            <div class="solicitud-encabezado">Fecha Solicitud</div>
            <div class="solicitud-encabezado">Descripción de la Solicitud</div>


            <?php
            $sol = getAllCotizaciones();

            if (count($sol)>0){
                //Existen registros
                foreach ($sol as $item){
                    echo  '<div class="solicitud-row">'.$item->nombre.'</div>';
                    echo  '<div class="solicitud-row">'.$item->email.'</div>';
                    echo  '<div class="solicitud-row">'.$item->fechaAlta.'</div>';
                    echo  '<div class="solicitud-row">'.$item->detalle.'</div>';
                }
            }
            else{
                echo '<div class="solicitud-row">No se encontraros elementos</div>';
            }

            ?>

            <div class="solicitud-row">Rodrigo Loya</div>
            <div class="solicitud-row">rloya@nube.unadmexico.mx</div>
            <div class="solicitud-row">15-may-2022</div>
            <div class="solicitud-row">Solicitud para adquirir 50 toneladas de arroz en grano</div>

            <div class="solicitud-row">Alberto Dominguez</div>
            <div class="solicitud-row">alberto@nube.unadmexico.mx</div>
            <div class="solicitud-row">15-sep-2021</div>
            <div class="solicitud-row">Solicitud para adquirir 70 paquetes</div>

            <div class="solicitud-row">Yessica Aruba</div>
            <div class="solicitud-row">yessiyess@nube.unadmexico.mx</div>
            <div class="solicitud-row">11-may-2021</div>
            <div class="solicitud-row">Solicitud para adquirir 200 galones de leche</div>
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