    <?php

        require 'config/database.php';
        require 'config/config.php';
        require 'cart/clientes-funciones.php';


            

    $db = new Database();
    $con = $db->conectar();
    // metodo get por que es por url
    $proceso = isset($_GET['pago']) ? 'pago' : 'login';

    $errors = [];

    // si no esta vacio la funcion que trae el post significa que se emvio el formulario y bamos a prosesar la imformacion

    if(!empty($_POST)){

        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $proceso = $_POST['proceso'] ?? 'login';
        
        if(esNulo([$usuario, $password])){
            $errors[] = "debe llenar todo los campos";
        }

        if(count($errors) == 0){
        $errors[] = login($usuario, $password, $con, $proceso);
        }

      
        // en caso de que no haiga ningun error en la lista registre nuestro usuario
      
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
 <style>
    .form-login{
      max-width: 350px;
    }
 </style>
</head>

<body>

    <!--Barra de navegación-->
    <?php include 'menu.php'; ?>
    <main class="form-login m-auto pt-4">
        <h2>iniciar secion</h2>
           <?php mostrarMensajes($errors); ?>
           <form class="row g-3" action="login.php" method="post" autocomplete="off">
           
           <input type="hidden" name="proceso" value="<?php echo $proceso; ?>">
           
           <div class="form-floating">
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="usuario" requireda>
                <label for="usuario">usuario</label>
        
            </div>
            <div class="form-floating">

                <input class="form-control" type="password" name="password" id="password" placeholder="password" requireda>
                <label for="password">contraseña</label>
            </div>
            <div class="d-grid gap-3 col-12">
                <button type="submit" class="btn btn-primary">ingresar</button>
            </div>
            <hr>

            
            <div class="col-12">
                ¿no tienes cuenta? <a href="registro.php"> registrate aqui</a>
            </div>
           </form>
    </main> 
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>