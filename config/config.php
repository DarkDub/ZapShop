<?php

define("CLIENT_ID", "Ad4mFrgbNaa4ulZNi7Plx0-e_jGeHV80zQYcwYjHaFwXvQ_Y2xLBYxbhb7xZiAXNa6IbYrlmM2MUx0vM");
define("CURRENCY", "USD");/* esto es una constante el nombre es en mayuscula y la clave para esa constante*/
define("KEY_TOKEN", "ABR.uli-021*");/* esto es una constante el nombre es en mayuscula y la clave para esa constante*/
define("MONEDA", "$");  

session_start();

$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>