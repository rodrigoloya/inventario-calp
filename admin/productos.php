<?php
    include './productos.component.php';
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
                    <li class="menu-item"><a href="../admin/productos.php">Productos por Vender</a> </li>
                    <li class="menu-item"><a href="../admin/cotizaciones.html">Consultar Solicitudes</a></li>
                    <li class="menu-item"><a href="../index.html">Cerrar Session</a></li>
                </ul>
            </nav>
        </header>

        <div class="content">
            <!--
o Antes de la tabla agregar un botón alineado a la derecha que tenga
como texto la palabra, agregar producto.
o Una tabla con 4 columnas que tendrán la siguiente información (debe
contener al menos 5 productos o filas).
▪ Clave de producto
▪ Nombre del producto
▪ Precio
▪ Acción con el siguiente texto (Ver, Editar, Borrar)
-->
<?php
try {
    $formStatus = '';
    if(isset($_GET["f"])){
        try {           
            $formStatus=$_GET["f"];
        } 
        catch(Exception $e) {
            echo $e->getMessage();
        }           
    
    }
/*
    $productos = getAllProductos();

    echo "<pre>";
      print_r($productos);*/
} 
catch (\Throwable $th) {
   print ($th);
}
  
    
?>
            <h2>Productos por Vender</h2>
 <?php
        if($formStatus === "success"){
            print ("<h3 class='success'>Envio del formulario fue exitoso.</h3>");
        }
        elseif($formStatus === "error"){
            print ("<h3 class='error'>Ocurrio un error al enviar el formulario.</h3>");
        }
?>
            <div class="agregar-producto">
                <button id="btnAgregarProducto">Agregar Producto</button>
            </div>

            <div class="tabla-admin-productos">
                <div class="admin-producto-encabezado">Clave Producto</div>
                <div class="admin-producto-encabezado">Nombre del Producto</div>
                <div class="admin-producto-encabezado">Presentacion</div>
                <div class="admin-producto-encabezado right">Precio</div>
                <div class="admin-producto-encabezado">Acción</div>

<?php
    $productos = getAllProductos();
    foreach ($productos as $item){
   echo '<div id="clave_'.$item->idProducto.'" class="admin-producto-row">'.$item->clave.'</div>';
   echo '<div id="nombre_'.$item->idProducto.'" class="admin-producto-row">'.$item->nombre.'</div>';
   echo '<div id="pres_'.$item->idProducto.'" class="admin-producto-row">'.$item->presentacion.'</div>';
   echo '<div id="precio_'.$item->idProducto.'" class="admin-producto-row right">'.$item->precio.'</div>';
   echo '<div class="admin-producto-row">';
   echo '    <a href="#" class="cell-link">Ver</a>';
   echo '    <a href="#" class="cell-link" onclick="editarRegistro('.$item->idProducto.')">Editar</a>';
   echo '    <a href="#" class="cell-link" onclick="borrarRegistro('.$item->idProducto.')">Borrar</a>';
   echo '</div>';
    }
?>
                <div class="admin-producto-row">1001</div>
                <div class="admin-producto-row">Atun en Lata</div>
                <div class="admin-producto-row right">155.00</div>
                <div class="admin-producto-row">
                    <a href="#" class="cell-link">Ver</a>
                    <a href="#" class="cell-link">Editar</a>
                    <a href="#" class="cell-link">Borrar</a>
                </div>

                <div class="admin-producto-row">1002</div>
                <div class="admin-producto-row">Leche</div>
                <div class="admin-producto-row right">44.00</div>
                <div class="admin-producto-row">
                    <a href="#" class="cell-link">Ver</a>
                    <a href="#" class="cell-link">Editar</a>
                    <a href="#" class="cell-link">Borrar</a>
                </div>

                <div class="admin-producto-row">1003</div>
                <div class="admin-producto-row">Huevo</div>
                <div class="admin-producto-row right">87.00</div>
                <div class="admin-producto-row">
                    <a href="#" class="cell-link">Ver</a>
                    <a href="#" class="cell-link">Editar</a>
                    <a href="#" class="cell-link">Borrar</a>
                </div>

                <div class="admin-producto-row">1004</div>
                <div class="admin-producto-row">Mantequilla</div>
                <div class="admin-producto-row right">44.00</div>
                <div class="admin-producto-row">
                    <a href="#" class="cell-link">Ver</a>
                    <a href="#" class="cell-link">Editar</a>
                    <a href="#" class="cell-link">Borrar</a>
                </div>

                <div class="admin-producto-row">1005</div>
                <div class="admin-producto-row">Arroz</div>
                <div class="admin-producto-row right">27.00</div>
                <div class="admin-producto-row">
                    <a href="#" class="cell-link">Ver</a>
                    <a href="#" class="cell-link">Editar</a>
                    <a href="#" class="cell-link">Borrar</a>
                </div>
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
    <div class="bg-modal">
        <div class="modal-content">
            <div class="modal-header"><h3>Agregar Producto</h3></div>
            <div class="close"> + </div>
            <form action="productos.component.php" method="post">
          
            <input type="hidden" name="idProducto" id="idProducto">
            <span>Clave:</span>
            <input type="text" name="clave" id="clave" placeholder="Clave del producto" required>
            <span>Nombre:</span>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" required>
            <span>Presentacion:</span>
            <input type="text" name="presentacion" id="presentacion" placeholder="Presentacion del producto" required>
            <span>Precio:</span>
            <input type="text" name="precio" id="precio" placeholder="Precio del producto" required>
            <div class="modal-footer">
                <button id="btnSubmit" name="btnSubmit" >Aceptar</button>
            </div>

            </form>
        </div>
    </div>
</body>

</html>

<script>
    const openButton = document.getElementById('btnAgregarProducto');
    const modal = document.querySelector('.bg-modal');
    const closeBtn = document.querySelector('.close');
    openButton.addEventListener('click', () => {
        modal.style.display = 'flex';
    }); 
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none'
    });

    function editarRegistro(idProducto){
        const clave = document.getElementById("clave_"+idProducto);
        const nombre = document.getElementById("nombre_"+idProducto);
        const pres = document.getElementById("pres_"+idProducto);
        const precio = document.getElementById("precio_"+idProducto);        

        document.getElementById('clave').value = clave.innerHTML;
        document.getElementById('nombre').value = nombre.innerHTML;
        document.getElementById('presentacion').value = pres.innerHTML;
        document.getElementById('precio').value = precio.innerHTML;
        document.getElementById("idProducto").value = idProducto;
        modal.style.display = 'flex';


    }
</script>