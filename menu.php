<header>
     <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container px-4 px-lg-2">
                <a class="navbar-brand" href="index.php">ZapShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="nosotros.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="catalogo.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="catalogo.php">Popular Items</a></li>
                                <li><a class="dropdown-item" href="catalogo.php">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                        <a href="carrito.php" class="btn btn-outline-dark me-2" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill" id="num_cart"><?php echo $num_cart ?></span>
                        </a>
                        <!-- si existe el user id significa que inicio secion -->
                        <?php if(isset($_SESSION['user_id'])){ ?>
                                <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle py-2" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>
                                <?php echo $_SESSION['user_name'];?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btn_session">
                                    <a class="dropdown-item" href="compras.php">Mis compras</a>
                                <a class="dropdown-item" href="logout.php">Cerrar seccion</a>
                                </div>
                                </div>
                        <?php } else {?>
                            <a href="login.php" class="btn btn-success"> ingresar</a>
                            <?php } ?>
                            
                </div>
            </div>
        </nav>
</header>