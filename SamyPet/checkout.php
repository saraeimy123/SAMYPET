<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = array();
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {

        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}
/* session_destroy();
print_r($_SESSION); */


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCatDog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <header>
        <section id="header">
            <a href="#"><img src="./IMG/logoS.png" class="logo" alt=""></a>
            <div>
                <ul id="navbar">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="gato-shop.php">Gatos</a></li>
                    <li><a href="perros-shop.php">Perros</a></li>
                    <li><a href="tienda.html">Tienda</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contacto.html">Contacto</a></li>

                    <!-- <a href="checkout.php" class="btn btn-primary">
                        Login <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                    </a> -->
                     <a href="#" id="close"><i class="fa-regular fa-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <i id="bar" class="fa-solid fa-outdent"></i>
            </div>
        </section>
    </header>


    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                        } else {
                            $total = 0;
                            foreach ($lista_carrito as $producto) {
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $descuento = $producto['descuento'];
                                $cantidad = $producto['cantidad'];
                                $precio_desc = $precio - (($precio * $descuento) / 100);
                                $subtotal = $cantidad * $precio_desc;
                                $total += $subtotal;
                        ?>

                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?> </td>
                                    <td>
                                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA .
                                                                                                        number_format($subtotal, 2, '.', ','); ?></div>
                                    </td>
                                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo
                                                                                                                $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                                </td>
                            </tr>

                    </tbody>
                <?php } ?>
                </table>
            </div>

            <?php if ($lista_carrito != null) { ?>
                <div class="row">
                    <div class="col-md-5 offset-md-7 d-grid gap-2">
                        <a href="pago.php" class="btn btn-primary btn-lg">Realizar pago<a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="IMG/logoS.png" alt="">
            <h4>Contactos</h4>
            <p><strong><i class="fa fa-location"></i> Direccion:</strong>Av. Fernando Wiesse Cdra. 44, San Juan de Lurigancho 15416
            </p>
            <p><strong><i class="fa fa-phone"></i> Telefono:</strong>+51 9659656215</p>
            <p><strong><i class="fa fa-envelope"></i> Correo:</strong> pet$catdgon.pe</p>
            <div class="follow">
                <h4>Siguenos</h4>
                <div class="icon">
                    <a href="https://www.facebook.com/profile.php?id=100094598029403"> <i class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com/petcatdog2023?igshid=ZGUzMzM3NWJiOQ=="><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCyVDHUG-qHL9GlmpGq-5JqA"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <center>
            <div class="col install">
                <h4>Instalar App (Proximamente)</h4>
                <p>App Store y Google Play</p>
                <div class="row" style="width:300px">
                    <img src="IMG/pay/app.jpg" alt="">
                    <img src="IMG/pay/play.jpg" alt="">
                </div>
                <p>Pagos Seguros</p>
                <img src="IMG/pay/pay.png" alt="">
            </div>
            <div class="copyright">
                <p>2024 Samipet.pe - Todos los derechos reservados - Diseño Web</p>
            </div>
        </center>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


</body>

</html>