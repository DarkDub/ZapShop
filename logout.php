<?php
 
 require 'config/config.php';

        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_cliente']);
 header('location: catalogo.php');


 ?>