<?php

require 'config/database.php';
require 'config/config.php';
    

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos != null){
        /*aqui la clave va a hacer el id del producto y la cantidad que va a tener */
        foreach ($productos as $clave => $cantidad){

            $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
            $sql->execute([$clave]);
            $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

        }

    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ZapShop</title>

<!-- Bootstrap CSS -->
<link rel="icon" type="image/x-icon" href="images/Nike.jpg"/>

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="css/estilos.css" rel="stylesheet">
</head>
<body>
<!--Barra de navegación-->
<header> 
     <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">ZapShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="nosotros.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="cart/" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="catalogo.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="catalogo.php">Popular Items</a></li>
                                <li><a class="dropdown-item" href="catalogo.php">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="checkout.php" class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $num_cart ?></span>
                        </a>
                    </form>
                </div>
            </div>
        </nav>
            </header>

<main class="flex-shrink-0">
    <div class="container px-4 px-lg-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>SubTotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($lista_carrito == null){
                        
                        echo'<tr>
                        <td colspan="5" class="text-center"><b> lista vacia</b>
                        </td>
                        
                        </tr>';
                    }else{
                        $total = 0;
                        foreach ($lista_carrito as $producto){
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];
                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;

                            $direc_images = 'images/productos/' . $_id . '/';

                            $rutaimg = $direc_images . 'producto.jpg';
                
                            if(!file_exists($rutaimg)){
                                $rutaimg = 'images/no-photo.jpg';
                            }
                
                            $imagenes = array();
                            if(file_exists($direc_images)){ 
                            $dir = dir($direc_images);/*lo que bamos aqui es ir al carpeta y nos va a regresar todos los archivos que contiene*/
                
                            /*si esto es dferente a fallse entonces dejalo pasa por que si es un archivo */
                
                            while(($archivo = $dir->read()) != false){
                                    /*strpos es para que busque los archivos con esa extencion */
                                if($archivo != 'producto.jpg' && (strpos($archivo, 'jpg') ||strpos($archivo, 'jpeg') )){
                                    $imagenes[] = $direc_images . $archivo;
                            }
                
                
                            }$dir->close();
                        }


                    ?>
                     <tr>
                        <td width="100">
                        <img src="<?php echo $rutaimg;?>" class="rounded" width="70">
                        </td>
                        <td width="500">
                        <?php echo $nombre; ?>
                        </td>
                        <div class="container-left">
                        
                        <td><?php echo MONEDA . number_format($precio,2, '.', ','); ?></td>
                        <td>
                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                        </td>
                        <td>

                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ',');?>

                        </div>
                        </td>
                        <td>
                            <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="h3"> Total</td>
                        <td colspan="5">
                            <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>
                    </tr>
                        </div>
                        
                </tbody>
                <?php } ?>
            </table>

        </div>
        <?php if($lista_carrito != null) { ?>
        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <a href="pago.php" class="btn btn-outline-dark">realizar pago</a>
            </div>

        </div>
      <?php } ?>
         <div class="">
        <h6 class="mb-0"><a href="catalogo.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
        </div>
        </div>


    </div>

</main>
<!-- Modal -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="eliminaModallLabel">Alerta</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                desea eliminar el producto de la lista?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
            <button id="btn-elimina" type="button" class="btn btn-danger" onclick="elimina()">Eliminar</button>
        </div>
        </div>
    </div>
    </div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="js/index.js"></script>

</body>
</html>