<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
    echo 'Error al procesar la peticion';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) {

            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $dir_images = 'IMG/products/' . $id . '/';

            $rutaImg = $dir_images . 'principal.png';
            if (!file_exists($rutaImg)) {
                $rutaImg = 'IMG/products/no-photos.jpg';
            }

            $imagenes = array();
            if(file_exists($dir_images)){
            $dir = dir($dir_images);

            while (($archivo = $dir->read()) != false) {
                if ($archivo != 'principal.png' && (strpos($archivo, 'png')) || (strpos($archivo, 'jpg'))) {
                    $imagenes[] = $dir_images . $archivo;
                }
            }
            $dir->close();
        }
        }
    } else {
        echo 'Error al procesar la peticion';
        exit;
    }
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

<body>
    <header>
    <section id="header">
        <a href="#"><img src="./IMG/logoS.png" class="logo" alt="" ></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Inicio</a></li>
                <li><a href="gato-shop.php">Gatos</a></li>
                <li><a href="perros-shop.php">Perros</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                <!-- <li><a href="checkout.php" class="btn btn-primary"> <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li> -->

                <a href="#" id="close"><i class="fa-regular fa-x"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar"  class="fa-solid fa-outdent"></i>
        </div>
    </section>
    </header>

    <!--Contenido-->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md1">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaImg ?>" class="d-block w-100">
                            </div>
                            <?php foreach ($imagenes as $img) { ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $img; ?>" class="d-block w-100">
                                </div>
                            <?php } ?>
                        </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-md-6 order-md-2">
                <h2><?php echo $nombre; ?></h2>
                
                <?php if($descuento > 0) { ?>
                    <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
                    <h2>
                   <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                   <small class="text-success"><?php echo $descuento;?>% descuento</small>
                    </h2>

                    <?php } else { ?>


                <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>
                
                <?php } ?>

                <p class="lead">
                    <?php echo $descripcion; ?>
                </p>
                <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="btn btn-success" type="button">Comprar ahora</button>
                    <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div>
</main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    function addProducto(id, token){
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id', id)
        formData.append('token', token)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => { 
            if (data.ok) {
          let elemento = document.getElementById("num_cart") 
          elemento.innerHTML = data.numero   
        }
        })
    }
</script>

</body>

</html>