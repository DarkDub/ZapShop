<?php 

require '../config/database.php';
require '../config/config.php';

if(isset($_POST['action'])){

    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    /*si  action es igual a agregar que esta en index.js  entonces realize las siguientes actividades las cuales serian recibir las cantidad que le agregamos*/
    if($action == 'agregar'){

    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
     $respuesta = agregar($id, $cantidad);
     /*si respuesta es mayor a 0 significa que si encontro imformacion y tiene datos para regresar*/
     if($respuesta > 0){
        $datos['ok'] = true;
     }else{
        $datos['ok'] = false;
     }
     $datos['sub'] = MONEDA . number_format($respuesta, 2, '.', ',');

    }else if($action == 'eliminar') {
        $datos['ok'] = eliminar($id);

    } else{
        $datos['ok'] = false;
    }
}else{
    $datos['ok'] = false;
}

echo json_encode($datos);

function agregar($id, $cantidad){
    /*le indicamos que la variable res de respuesta sea ugual a 0 */
    $res = 0;
    if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){
        /*con esto vamos a validar que el id del producto exista y si existe hacemos lo siguiente*/
        if(isset($_SESSION['carrito']['productos'][$id])){
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
            $sql->execute([$id]);
            /*si esto es mayor a 0 en me va decir que si encontro un elemto y  lo va arrojar */
            if($sql->fetchColumn() > 0){
                $sql = $con->prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1" );
                $sql->execute([$id]);
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $precio_desc = $precio - (($precio * $descuento)/ 100);
                $res = $cantidad * $precio_desc;

                return $res;
        }
    }else{
        return $res;
    }

}

}

function eliminar($id){
    if($id > 0){
        if(isset($_SESSION['carrito']['productos'][$id])){
            unset($_SESSION['carrito']['productos'][$id]);
            return true;

        }
    } else {
        return false;
    }
}

?>