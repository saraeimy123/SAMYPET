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
}else {
    header("Location: index.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCatDog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
  </head>
</head>
<body>
<header data-bs-theme="dark">
<body>
    <section id="header">
        <a href="#"><img src="./IMG/logoS.png" class="logo" alt="" ></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Inicio</a></li>
                <li><a href="gato-shop.php">Gatos</a></li>
                <li><a href="perros-shop.php">Perros</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                <!-- <li><a href="checkout.php" class="btn btn-primary">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li> -->

                <a href="#" id="close"><i class="fa-regular fa-x"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar"  class="fa-solid fa-outdent"></i>
        </div>
    </section>
</header>
<!-- contenido -->
<main>
   
    <div class="container">
    <div class="row">
        <div class="col-6">
            <h4>Detalles de pago</h4>
            <div id="paypal-button-container"></div>
        </div >
        <div class="col-6">
       <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php if ($lista_carrito == null) {
                        echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                    }else {
                        $total = 0;
                        foreach ($lista_carrito as $producto) {
                            $_id = $producto['id'];
                            $nombre = $producto['nombre'];
                            $precio = $producto['precio'];
                            $descuento = $producto['descuento'];
                            $cantidad = $producto['cantidad'];
                            $precio_desc = $precio-(($precio * $descuento) / 100);
                            $subtotal = $cantidad * $precio_desc;
                            $total += $subtotal;
                        ?>
                     
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        
                        
                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
                            number_format($subtotal,2, '.', ','); ?></div>
                        </td>
                    </tr>
                    <?php } ?> 
                    
                    <tr>
                        
                        <td colspan="2">
                        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.',','); ?></p>
                        </td>
                    </tr>
                    
                </tbody>
            <?php } ?>
        </table>
       </div>
       
    </div>
    </div>
    </div>
</main>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=ATzKZ3pYSCU0yibGHWr_fB1lS_S3WuHZ291e4vwd8TtEHpp0rMhDgsqptC0XZhUOWntvpPj1xmdPvnkK&currency=MXN"></script>

<script>
       paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions){
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?php echo $total; ?>
                    }
                }]
            });
        },
        onApprove: function(data, actions){
            let URL = ''
            actions.order.capture().then(function(detalles){
                
                console.log(detalles)
                
               
            
            });
        },
        onCancel: function(data){
            alert('pago cancelado')
            console.log(data);
        }
       }).render('#paypal-button-container');
    </script>
</body>
</html>