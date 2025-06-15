    <?php

        require 'config/database.php';
        require 'config/config.php';
        require 'cart/clientes-funciones.php';


            

    $db = new Database();
    $con = $db->conectar();

    $errors = [];

    // si no esta vacio la funcion que trae el post significa que se emvio el formulario y bamos a prosesar la imformacion

    if(!empty($_POST)){
        $nombres = trim($_POST['nombres']);
        $apellidos = trim($_POST['apellidos']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $dni = trim($_POST['dni']);
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $repassword = trim($_POST['repassword']);
        
        if(esNulo([$nombres, $email, $telefono, $dni, $usuario, $password, $repassword])){
            $errors[] = "debe llenar todo los campos";
        }

        if(!esEmail($email)){
            $errors[] = "la direccion el correo no es valida";
        }

        if(!validaPassword($password, $repassword)){
             $errors[] = "las contraseñas no coinsiden";
        }
        if(usuarioExiste($usuario, $con)){
            $errors[] = "el nombre de usuario $usuario ya existe";
        }
        
        if(emailExiste($email, $con)){
            $errors[] = "el correo electronico $email ya existe";
        }

        // en caso de que no haiga ningun error en la lista registre nuestro usuario
        if(count($errors) == 0){

        // aqui le pasamos los valores al arreglo que esta en la funcion
        $id = RegistraCliente([$nombres, $apellidos, $email, $telefono, $dni], $con);

        if($id > 0){
            // aqui recibo la clave en texto plano pero con eta funcion la cifro para que sea mas segura
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $token = generarToken();
            if(!registraUsuario([$usuario, $pass_hash, $token, $id], $con)){
            $errors[] = "error al registrar cliente";
                
            }
        }else{
            $errors[] = "error al registrar cliente";

        }
      

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
   <?php include 'menu.php'; ?>
    <main>
        <div class="container">
            <h2>Datos del cliente</h2>


            <?php mostrarMensajes($errors); ?>

            <form class="row g-3" action="registro.php" method="post" autocomplete="off">
                <div class="col-md-6">
                    <label for="nombres"><span class="text-danger">*</span>nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="apellidos"><span class="text-danger">*</span>apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email"><span class="text-danger">*</span>correo electronico</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span id="validaEmail" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="telefono"><span class="text-danger">*</span>telefono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="dni"><span class="text-danger">*</span>DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control" requireda>
                </div>
                
                <div class="col-md-6">
                    <label for="usuario"><span class="text-danger">*</span>usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" requireda>
                    <span id="validaUsuario" class="text-danger"></span>
                </div>
                
                <div class="col-md-6">
                    <label for="contraseña"><span class="text-danger">*</span>contraseña</label>
                    <input type="password" name="password" id="contraseña" class="form-control" requireda>
                </div>
                
                <div class="col-md-6">
                    <label for="repassword"><span class="text-danger">*</span>repetir contraseña</label>
                    <input type="password" name="repassword" id="repassword" class="form-control" requireda>
                </div>
                <i><b>Nota:</b> los campos son obligatorios </i>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

            </form>
        </div>
    </main> 
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function(){
            existeUsuario(txtUsuario.value)
        }, false)
        
        let txtEmail = document.getElementById('email')
        txtEmail.addEventListener("blur", function() {
            existeEmail(txtEmail.value)
        }, false)
        
        function existeEmail(email){
            let url = 'cart/clienteajax.php';
            let formData = new FormData()
            formData.append("action", "existeEmail")
            formData.append("email", email)

            // nos permite hacer peticiones
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                // estamos tomando el arreglo que se combirtio en objeto ok que esta ubicado en clienteajax.php
                if(data.ok){
                    document.getElementById('email').value = ''
                    document.getElementById('validaEmail').innerHTML = 'email en uso'

                }else{
                    document.getElementById('validaEmail').innerHTML = ''

                }
            })
        }

        function existeUsuario(usuario){
            let url = 'cart/clienteajax.php';
            let formData = new FormData()
            formData.append("action", "existeUsuario")
            formData.append("usuario", usuario)

            // nos permite hacer peticiones
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                // estamos tomando el arreglo que se combirtio en objeto ok que esta ubicado en clienteajax.php
                if(data.ok){
                    document.getElementById('usuario').value = ''
                    document.getElementById('validaUsuario').innerHTML = 'usuario en uso'

                }else{
                    document.getElementById('validaUsuario').innerHTML = ''

                }
            })
        }
        
        
        
    </script>

</body>
 

</html>