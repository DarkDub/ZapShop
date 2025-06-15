<?php

require 'config/database.php';
require 'config/config.php';
    

$db = new Database();
$con = $db->conectar();

$id_transaccion = isset($_GET['key']) ? $_GET['key'] : '0';
    

  $error = '';

  if ($id_transaccion == '') {
            $error = 'Error al precesar la peticion';
        } else {
            $sql = $con->prepare("SELECT count(id) FROM compra WHERE id_transaccion=? AND status=?");
                $sql->execute([$id_transaccion, 'COMPLETED']);
                /*si esto es mayor a 0 en me va decir que si encontro un elemto y  lo va arrojar */
                if($sql->fetchColumn() > 0){
                    $sql = $con->prepare("SELECT id, fecha, email, total FROM compra WHERE id_transaccion=? AND status=? LIMIT 1");
                    $sql->execute([$id_transaccion, 'COMPLETED']);
                    $row = $sql->fetch(PDO::FETCH_ASSOC);

                    $idCompra = $row['id'];
                    $total = $row['total'];
                    $fecha = $row['fecha'];

                    $sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra=?");
                    $sqlDet->execute([$idCompra]);

        } else {
            echo 'error al comprobar la compra';
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
    <link href="css/preload.css" rel="stylesheet">
</style>
</head>   
<body>
<!--Barra de navegación-->
    <?php include 'menu.php'; ?>
  

<main>
    <div class="container px-4 px-lg-5">
     <!-- strlen para contar los caracteres que tiene una variable -->
    <?php if(strlen($error) > 0) { ?>

        <div class="row">
            <div class="col">
                <h3><?php echo $error; ?></h3>
            </div>

        </div>

    <?php } else { ?>
        <div class="row">
           <div class="col">
                <b>id de la compra: </b><?php echo $id_transaccion; ?><br>
                <b>fecha de la compra: </b><?php echo $fecha; ?><br>
                <b>total canselado: </b><?php echo MONEDA . number_format($total, 2, '.', ','); ?><br>
           </div>
        </div>
        <div class="row">
           <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th>cantidad</th>
                        <th>producto</th>
                        <th>valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)){ $importe = $row_det['precio'] * $row_det['cantidad'];?>
                        
                        <tr>
                            <td> <?php echo $row_det['cantidad']; ?></td>
                            <td> <?php echo $row_det['nombre']; ?></td>
                            <td> <?php echo MONEDA . number_format($importe, 2, '.', ',') ; ?></td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
           </div>
        </div>
        <?php }?>

    </div>    


</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="js/index.js"></script>
</body>
</html>