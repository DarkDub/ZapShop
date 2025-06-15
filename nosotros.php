<?php 
require 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ZapShop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images/Nike.jpg"/>

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos.css">

        <!-- Core theme CSS (includes Bootstrap)-->
        <style>
            header{
                background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.75)), url('images/hero.jpg');
                background-repeat: no-repeat;
                background-size: cover;
             }
             body {
            font-family: Arial, sans-serif;
        }
        .bg-primary {
            background-color: #333;
            color: #fff;
        }
        .bg-dark {
            background-color: #000;
            color: #fff;
        }
        .py-5 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .about-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .container {
            max-width: 900px;
        }
        </style>
    </head>
    <body>
   
     <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container px-4 px-lg-7">
                <a class="navbar-brand" href="index.php">ZapShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="catalogo.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="catalogo.php">Popular Items</a></li>
                                <li><a class="dropdown-item" href="catalogo.php">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="carrito.php" class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $num_cart ?></span>
                        </a>
                    </form>
                </div>
            </div>
        </nav>
        <header class="py-5">

                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">¡Nosotros somos tu destino!</h1>
                                <p class="lead fw-normal text-white-50 mb-4"></p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-outline-light btn-lg px-4 me-sm-3" href="#features">Explorar!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

    <!-- Sección Acerca de Nosotros -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="images/zap2.jpg" alt="Nuestra Tienda" class="about-img">
            </div>
            <div class="col-md-6">
                <h2>Nuestra Historia</h2>
                <p>ZapShop es mucho más que una tienda de calzado. Somos tu destino de confianza para encontrar zapatos de alta calidad que se adaptan a tu estilo y comodidad. Con más de [18] años en la industria, nos enorgullecemos de ser parte de tu vida y ayudarte a expresar tu personalidad a través del calzado. Nuestra misión es simple: proporcionarte una experiencia de compra excepcional y una selección diversa de estilos para toda la familia. En ZapShop, no solo vendemos zapatos, creamos conexiones y cultivamos la confianza de nuestros clientes. ¡Bienvenido a la familia ZapShop!<p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h2>Nuestra Misión</h2>
                <p>Nuestra misión en ZapShop es simple pero apasionante: proporcionar a nuestros clientes zapatos de calidad que combinen estilo y comodidad a precios accesibles. Creemos que los zapatos son una expresión de la personalidad y el estilo, y queremos ayudarte a encontrar el par perfecto para cada ocasión. Trabajamos directamente con marcas reconocidas y diseñadores para garantizar la calidad de nuestros productos.</p>
            </div>
            <div class="col-md-6">
                <img src="images/zap1.jpg" alt="Zapatos de Calidad" class="about-img">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <img src="images/zap3.jpg" alt="Equipo de ZapShop" class="about-img">
            </div>
            <div class="col-md-6">
                <h2>Nuestros Valores</h2>
                <p>En ZapShop, nuestros valores son la base de nuestro compromiso. Valoramos la calidad de nuestros productos, la diversidad de estilos y la satisfacción del cliente por encima de todo. Nuestro equipo está comprometido en brindar un servicio excepcional y ayudarte a tomar decisiones informadas al elegir el calzado adecuado.</p>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 ZapShop</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
