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
                    <li class="menu-item"><a href="./catalogo.php" >Catálogo</a> </li>
                    <li class="menu-item"><a href="./cotizacion.php" >Cotización</a></li>
                    <li class="menu-item"><a href="./contacto.html" >Contacto</a></li>
                    <li class="menu-item"><a href="./admin/login.html">Administración</a></li>
                </ul>
            </nav>
        </header>

        <div class="content">
<?php
    $isFiltered = false;
    $lstFilteredProd = [];
    $consola = new Consola();
    class Consola {

        public function log($msg){
            echo "<script>console.log('$msg')</script>";
            
        }
    }

    class Producto {
        public $clave;
        public $nombre;
        public $descripcion;
        public $precio;
        public $cantidad;
        public $presentacion;

        function __construct(){ }

        function getNombre(){
            return $this->nombre;
        }

        function getContentFilter(){
            $result = "$this->clave $this->nombre $this->descripcion $this->presentacion $this->precio $this->cantidad";
            $result = strtolower($result);
            echo "<script>console.log('$result')</script>";
            return $result;
        }

    }
    $lstProductos = array();
    $iClave = 1001;

    $lstProductos[0] = new Producto();
    $lstProductos[0]->clave = $iClave++;
    $lstProductos[0]->nombre = "Atun en Lata";
    $lstProductos[0]->descripcion = "Atun en Lata";
    $lstProductos[0]->precio = "155.00";
    $lstProductos[0]->cantidad = "20.00";
    $lstProductos[0]->presentacion = "En agua en lata";

    $lstProductos[1] = new Producto();
    $lstProductos[1]->clave = $iClave++;
    $lstProductos[1]->nombre = "Leche";
    $lstProductos[1]->descripcion = "Leche";
    $lstProductos[1]->precio = "44.00";
    $lstProductos[1]->cantidad = "20.00";
    $lstProductos[1]->presentacion = "Bote de 1gal";

    $lstProductos[2] = new Producto();
    $lstProductos[2]->clave = $iClave++;
    $lstProductos[2]->nombre = "Huevo";
    $lstProductos[2]->descripcion = "Huevo";
    $lstProductos[2]->precio = "87.00";
    $lstProductos[2]->cantidad = "20.00";
    $lstProductos[2]->presentacion = "Paquete con 12";

 
    $lstProductos[3] = new Producto();
    $lstProductos[3]->clave = $iClave++;
    $lstProductos[3]->nombre = "Mantequilla";
    $lstProductos[3]->descripcion = "Mantequilla";
    $lstProductos[3]->precio = "46.00";
    $lstProductos[3]->cantidad = "20.00";
    $lstProductos[3]->presentacion = "Paquete de 500g";

    $lstProductos[4] = new Producto();
    $lstProductos[4]->clave = $iClave++;
    $lstProductos[4]->nombre = "Arroz";
    $lstProductos[4]->descripcion = "Arroz";
    $lstProductos[4]->precio = "27.00";
    $lstProductos[4]->cantidad = "20.00";
    $lstProductos[4]->presentacion = "Paquete de 1000g";

    $lstProductos[5] = new Producto();
    $lstProductos[5]->clave = $iClave++;
    $lstProductos[5]->nombre = "Coca Cola";
    $lstProductos[5]->descripcion = "Refresco Gasificado";
    $lstProductos[5]->precio = "20.00";
    $lstProductos[5]->cantidad = "235.00";
    $lstProductos[5]->presentacion = "Envase con 600ml";

    $lstProductos[6] = new Producto();
    $lstProductos[6]->clave = $iClave++;
    $lstProductos[6]->nombre = "Jabón Zote";
    $lstProductos[6]->descripcion = "Jabón en pastilla";
    $lstProductos[6]->precio = "15.00";
    $lstProductos[6]->cantidad = "895.00";
    $lstProductos[6]->presentacion = "Pieza";



    function filter($filtro, $lstProductos, $consola)  {
        $result = [];
        $i = 0;
        foreach($lstProductos as $item) {
            $findInd = strpos($item->getContentFilter(), strtolower( $filtro));
             $consola->log($findInd);
            if($findInd != ""){
                $result[$i] = $item;
                $i++;
            }
        }
       // print_r($result);
        return $result;
    }

    $lstFilteredProd = $lstProductos;

    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["search"])){
        $isFiltered = true;

        $filtro = $_GET["search"];
        if(strlen( $filtro) > 0){
            $lstFilteredProd = filter($filtro,$lstProductos, $consola);
        }
        else{
            $lstFilteredProd = $lstProductos;
        }

       // print_r($lstFilteredProd);
    }




     
?>
            <!--
  Título de la página con la etiqueta H2
o Una tabla con 3 columnas que tendrán la siguiente información (debe
contener al menos 5 productos o filas).
▪ Clave de producto
▪ Nombre del producto
▪ Precio
            -->
            <h2>Catálogo de productos</h2>
            <form action="catalogo.php" method="get">
            <div class="buscar-contenido">
                <input type="text" name="search" id="search" class="buscar" placeholder="Texto a buscar">
                <button id="btnBuscar" name="btnBuscar" class="btn-buscar">Buscar</button>
            </div>
            </form>
            <div class="tabla-catalogo">
                <div class="tabla-encabezado">Clave Producto</div>
                <div class="tabla-encabezado">Nombre Producto</div>
                <div class="tabla-encabezado">Descripcion</div>
                <div class="tabla-encabezado">Presentacion</div>
                <div class="tabla-encabezado right">Precio</div>
                <div class="tabla-encabezado right">Cantidad</div>
                <?php 
                    foreach ($lstFilteredProd as $item){
                        echo '<div class="row">'.$item->clave.'</div>';
                        echo '<div class="row">'.$item->nombre.'</div>';
                        echo '<div class="row">'.$item->descripcion.'</div>';
                        echo '<div class="row">'.$item->presentacion.'</div>';
                        echo '<div class="row right">'.$item->precio.'</div>';
                        echo '<div class="row right">'.$item->cantidad.'</div>';
                        
                    }
                ?>
                 
            </div>
        </div>
        <pre><?php //print_r($lstProductos);?> </pre>
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