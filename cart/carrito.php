<?php 

require '../config/config.php';

if(isset($_POST['id'])){
    $id = $_POST['id']; 
    $token = $_POST['token']; 

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){

        /* lo que estamos haciendo aqui es que tenemos el producto 1 y va a tener una cantidad en caso del que el usuario quiera 2 cantidades entonces vamos a hacer la siguiente modificacion le sumaremos 1 a su cantidad por que ya ese producto existe */

        if(isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] += 1;
        } else {
            $_SESSION['carrito']['productos'][$id] = 1;
        }

        /* estamos guardando los productos en $datos y en counr es contar cuantos productos tenemos */
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    

    }else{
        $datos['ok'] = false;

    }


} else {
    $datos['ok'] = false;
}
/*aqui lo regresamos en formato json */
echo json_encode($datos);
