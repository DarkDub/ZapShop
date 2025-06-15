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

    }else{
        header('location: index.php');
        exit;
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


</head>
<body>
<?php include 'menu.php' ?>
<main>
    <div class="container  px-4 px-lg-5 py-3">
        <div class="row">
            <div class="col-6">
                <h4 class="py-4">Metodo de pago</h4>
                <div id="paypal-button"></div>
            </div>
        <div class="col-6">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <h2 class="text-center py-3">Productos</h2>
                    <tr>
                        <th width="500">Producto</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($lista_carrito == null){
                        echo'<tr><td colspan="5" class="text-center"><b> lista vacia</b></td></tr>';
                    }else{
                        $total = 0;
                        foreach ($lista_carrito as $producto){
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];
                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;
                            

                    ?>
                    <tr>
                        <td>
                        <?php echo $nombre; ?>
                        </td>
                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ',');?>
                        </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">
                            <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>

        </div>
       
        </div>
    </div>
</div>    
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>
<script>
  
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total ?>
                        }
                    }] 
                });
            },
            onApprove: function(data, actions){
                let url = 'cart/captura.php'
                actions.order.capture().then(function(detalles) {
                    console.log(detalles)   
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    }).then(function(response){
                       
                            window.location.href='detalle_compra.php?key=' + detalles['id'];

                        // aqui me emvia a detalle_compra.php y ala url le suma el id de la compra que esta en captura.php
                    })
                });

            },
        }).render('#paypal-button');

       
    </script>
 </body>
</html>