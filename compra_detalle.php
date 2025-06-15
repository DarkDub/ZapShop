    <?php

        require 'config/database.php';
        require 'config/config.php';
        require 'cart/clientes-funciones.php';


    $token_session = $_SESSION['token'];
    //  sino existe que sea nulo
    $token = $_GET['token'] ?? null;
    $orden = $_GET['orden'] ?? null;

    if($orden == null || $token == null || $token != $token_session ){
        header("location: compras.php");
        exit;
    }
     $db = new Database();
    $con = $db->conectar();

    $sqlCompra = $con->prepare("SELECT id, id_transaccion, fecha, total FROM compra WHERE id_transaccion = ? LIMIT 1");
    $sqlCompra->execute([$orden]);
    $rowCompra = $sqlCompra->fetch(PDO::FETCH_ASSOC);

    $idCompra = $rowCompra['id'];
    $fecha = new DateTime($rowCompra['fecha']);
    $fecha = $fecha->format('d/m/Y H:i:s');

    $sqlDetalle = $con->prepare("SELECT id, id_compra, nombre, precio, cantidad FROM detalle_compra WHERE id_compra = ?");
    $sqlDetalle->execute([$idCompra]);


   
    

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
  <?php include 'menu.php'; ?>
    <main>
        <div class="container">
           <div class="row">
            
  <div class="row">
    <div class="col-12 col-md-3">
             <div class="">
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Detalles de compra</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha: </strong><?php echo $fecha?></p>
                        <p><strong>Orden: </strong><?php echo $rowCompra['id_transaccion']?></p>
                        <p><strong>Total: </strong><?php echo  MONEDA .' '.number_format($rowCompra['total'], 2, '.', ',');?></p>
                    </div> 

                </div>
            </div>
    </div>
    <div class="col-12 col-md-8">
     <div class="">
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $sqlDetalle->fetch(PDO::FETCH_ASSOC)){
                         $precio = $row['precio'];   
                         $cantidad = $row['cantidad'];   
                         $subtotal = $precio * $cantidad;   
                        ?>
                        <tr>
                            <td><?php  echo $row['nombre']; ?></td>
                            <td><?php echo  MONEDA . ' ' .number_format($precio, 2, '.', ',');?></td>
                            <td><?php  echo $row['cantidad']; ?></td>
                            <td><?php echo  MONEDA . ' ' .number_format($subtotal, 2, '.', ',');?></td>
                        
                        </tr>

                        <?php }?>
                    </tbody>

                </table>
              </div>
     </div>
    </div>
   
  </div>
</div>

        </div>
    </main> 
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
 

</html>