    <?php

        require 'config/database.php';
        require 'config/config.php';
        require 'cart/clientes-funciones.php';


            

    $db = new Database();
    $con = $db->conectar();

    $token = generarToken();
    $_SESSION['token'] = $token;
    $idCliente = $_SESSION['user_cliente'];

    $sql = $con->prepare("SELECT id_transaccion, fecha, status, total FROM compra WHERE id_cliente=? ORDER BY DATE(fecha) ASC");
      $sql->execute([$idCliente]);
              

    // si no esta vacio la funcion que trae el post significa que se emvio el formulario y bamos a prosesar la imformacion


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
            <h4>Mis compras</h4>

            <hr>
            <?php while($row = $sql->fetch(PDO::FETCH_ASSOC)) {?>

            <div class="card mb-3 border-primary">
            <h5 class="card-header">
                <?php echo $row['fecha']; ?>
            </h5>
            <div class="card-body">
                <h5 class="card-title">folio: <?php echo $row['id_transaccion'];  ?></h5>
                <p class="card-text">total: <?php echo $row['total'];?> </p>
                <a href="compra_detalle.php?orden=<?php echo $row['id_transaccion']; ?>&token=<?php echo $token; ?>" class="btn btn-primary">detalle compra</a>
            </div>
            </div>
           <?php } ?>
        </div>
        
    </main> 
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
 

</html>