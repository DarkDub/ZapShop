<?php 

    function esNulo(array $parametros)
    // con foreach recoremos el arreglo strlen() es para mirar lalongitd de la cadena trim para que quite los espacion al inicio y al final de la cadena
    {
        foreach($parametros as $parametro){
            if(strlen(trim($parametro)) < 1 ){
                return true;
            }
        }
        return false;
    }

    function esEmail($email){
      if( filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
      } 
      return false;
    }

    function validaPassword($password, $repassword){
        // si ambas variables son iguales retornamos verdadero
        if(strcmp($password, $repassword) === 0){
            return true;
        }
        return false;
    }


 function generarToken()
// con esto creamos un identificador para que al momento que se realize la solicitud pueda generarlo pero tambien sea aleatorio aunque sea en el mismo segundo qe lo solicite diferentes clientes
{
  return md5(uniqid(mt_rand(), false));
}

function RegistraCliente(array $datos, $con)
{
    // se colocan signos de interrogacion por que estamos trabajando con pdo

    $sql =$con->prepare ("INSERT INTO clientes(nombres, apellidos, email, telefono, dni, estatus, fecha_alta) VALUES (?,?,?,?,?,1,now())");
    // en caso de que esto se ejecute correstamente nos inserte el id o el usuario
    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;
 
}

function registraUsuario(array $datos, $con)
{

    $sql =$con->prepare ("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES (?,?,?,?)");
    if($sql->execute($datos)){
        return true;
    }
    return false;

}

function usuarioExiste($usuario, $con)
{
//    limit esbuscame el primero

    $sql =$con->prepare ("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    // con esto bamos a veriguar cuantas columna nos esta arrojando si existe este usuario nos arroja una que seria el id sino nos va a arrojar 0
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
 
}
function emailExiste($email, $con)
{

    $sql =$con->prepare ("SELECT id FROM clientes WHERE email LIKE ? LIMIT 1");
    $sql->execute([$email]);
    // con esto bamos a veriguar cuantas columna nos esta arrojando si existe este usuario nos arroja una que seria el id sino nos va a arrojar 0
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
 
}

function mostrarMensajes(array $errors){
    if(count($errors) > 0){
        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>'. $error .'</li>';
        }
        echo'<ul>';
        echo'<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>      
        </div>';
    }
}

function login($usuario, $password, $con, $proceso){

    $sql = $con->prepare("SELECT id, usuario, password, id_cliente FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    // en caso e que exista alguna que me regrese
    if($row = $sql->fetch(PDO::FETCH_ASSOC)){
        if(esActivo($usuario, $con)){
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['usuario'];
                $_SESSION['user_cliente'] = $row['id_cliente'];
                if($proceso == 'pago'){
                header("location: carrito.php");

                } else {
                header("location: catalogo.php");

                }
                exit;
            }
        } else {
            return 'el usuario no ha sido activado';
        }

        return 'El usuario y/o contraseña estan incorrecto';

    }
}

function esActivo($usuario, $con){
        $sql = $con->prepare("SELECT activacion FROM usuarios WHERE usuario LIKE ? LIMIT 1");
        $sql->execute([$usuario]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row['activacion'] == 1){
            return true;
        }
        return false;
}

?>