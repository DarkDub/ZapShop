    <?php

        require 'config/database.php';
        require 'config/config.php';
            

    $db = new Database();
    $con = $db->conectar();

    /*ahora bamos a realizar nuestra consulta pasando la conexion que se va a llamar prepare y con esto creamos consultas preparadas*/
    $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
    $sql->execute();
    /*una vez que se ejecute sql nos trae el resultado en la siquiente variable y lo vamos a traer con la funcion fetchALL por que estamos llamando a todos los productos que estan en la tabla*/
    /*(PDO::FETCH_ASSOC) aqui lo va asociar mediante el nombre de cada columna tambien puede ser combinado */
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    // print_r($_SESSION);


    //session_destroy();



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
    <style>
        .btn_detalles{
            padding: 7px 12px;
            border: 1px solid #000;
            border-radius: 5px;
            color: white;
            background-color: black;
            text-decoration: none;
        }
        .btn_detalles:hover{
            color: black;
            background-color: white;
            border-color: black;
            transition: 0.3s;
        }
  
    </style>
</head>

<body class="">
    <!--Barra de navegación-->
    <?php include 'menu.php'; ?>
  
    <main class="flex-shrink-0">
        <div class="container px-4 px-lg-2">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php foreach($resultado as $row) { ?>
                <div class="col mb-2">
                        <div class="card shadow-sm h-100">
                            <?php

                            $id = $row['id'];
                            $imagen = "images/productos/" . $id . "/producto.jpg";

                            if(!file_exists($imagen)){ /*si no existe la ruta */
                                $imagen = "images/no-photo.jpg";
                            }

                            ?>

                                <img src="<?php echo $imagen; ?>" class="card-img-top d-block w-100">

                            <div class="card-body">
                                <p class="card-title"><?php echo $row['nombre'] ?></p>
                                <p class="card-text"><strong>$ <?php echo number_format($row['precio'], 2, '.', ','); ?></strong></p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN);?>" class="btn_detalles">Detalles</a>
                                   <!--hash_hmac() nos va a permitir sifrar imformacion mediante una clave -->
                                    </div>
                                     <button class="btn btn-outline-dark" type="button" id="#addProduct" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN)?>')">agregar</button>
              
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
            </div>
        </div>
    </main>
   
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <script>
      
    function addProducto(id, token){
    let url = 'cart/carrito.php'
    /*esto nos va ayudar a emviar los parametros por medio de post */
    let formData = new FormData()
    formData.append('id', id)
    formData.append('token', token)

    fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if (data.ok) {
                let elemento = document.getElementById('num_cart')
                elemento.innerHTML = data.numero
                
            
            }
        })
}
 </script>
</body>
 

</html>