<?php

class Database
 {
    /* direccion de donde se encuentra nuestro motor de base de datos en este caso es localhost por que esta en nuestra propia maquina*/
    private $hostname = "localhost";
    /*estan son las propiedades que nos a yudaran a conectarnos a nuestro motor de base de datos */
    private $database = "dbtienda";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";


    function conectar() {

    
        /* aqui nos estamos conectando a nuestra base de datos y la bariable ($conexion esta siendo igual a nuetra cadena de conexion y la conectamos con mysql ";" se agrega para decir que nuestro host a terminado ) */
        try{
            /*  $conexion = mysqli_connect("localhost", "root", "", "tienda_online");*/
       
        $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset;

     
        
        
        /* esto es un arreglo por que bamos a agregarle barias opciones */

         $options = [

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false /*esto es una configuracion para evitar que las preparacion que hagamos para las consultas no sean emuladas sino reales y tengan seguridad  */
         ];

         $pdo = new PDO($conexion, $this->username, $this->password, $options);

         return $pdo;/*ya trae la conexion ala base de datos */

        } catch(PDOException $e){/*bamos a emviar un error por medio de catch y la variable $e va a capturar un mensaje */
            echo 'Error conexion: ' . $e->getMessage();
            exit;


        }
    }


    




}