
<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();


$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
session_destroy();
//print_r($_SESSION); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SamyPet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <script src="//code.tidio.co/vsle43v0dem4tk1bfit53g8wir4fqdtu.js" async></script>
</head>
<body>
    <section id="header">
        <a href="#"><img src="./IMG/logoS.png" class="logo" alt="" ></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Inicio</a></li>
                <li><a href="gato-shop.php">Gatos</a></li>
                <li><a href="perros-shop.php">Perros</a></li>
                <li><a href="blog.html">Tips</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                
               
                <a href="login.html" class="btn btn-primary">
                        Login <span id="num_cart" class="badge bg-secondary"></span>
                    </a>
                <a href="#" id="close"><i class="fa-regular fa-x"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar"  class="fa-solid fa-outdent"></i>
        </div>
    </section>
    
    <section id="hero">
    </section>
    
    
        <section class="about-us">
            <p>Somos una tienda de mascotas especializada en el cuidado, arreglo y comodidad de tu mascota a través de nuestros servicios y orientaciones para el buen cuidado de su salud física y mental.</p>
            <p>Contamos con personal responsable que atenderá cada pedido o consulta que realice el comprador de una manera rápida y segura.</p>
            <p>Poseemos espacio especialmente para cada mascota, con sus respectivos juguetes y lugares de descanso para mejorar su estadía y comodidad.</p>
            <p>En caso de que la mascota se encuentre en peligro por tema de salud o algún accidente, trabajamos de la mano con veterinarios expertos y dispuestos para atenderlos rápido y sin inconveniente alguno.</p>
        </section>
    
    
    <div class="container">
    <h2>Tienda de Mascotas</h2>
    <section>
            <div id="cont-categ">
                <div class="tarjetas">
                    <p>Reserva cita</p>
                    <a href="contacto.html"><img src="IMG/reservacita.png" alt="Reserva cita"></a>
                </div>
                <div class="tarjetas">
                    <p>Gatos</p>
                    <a href="gato-shop.php"><img src="IMG/cat.png" alt="Catálogo de productos para gatos"></a>
                    
                </div>
                <div class="tarjetas">
                    <p>Perros</p>
                    <a href="perros-shop.php"><img src="IMG/dog.png" alt="Catálogo de productos para perros"></a>
                </div>
            </div>
        </section>
</div>

    <section id="banner" class="section-m1">
        <h4>SAMYPET</h4>
        <h2> <SPan></SPan>Ropa y Accesorios</h2>
        <button  onclick="window.location.href='gato-shop.php'" class="btn btn-danger" type="button">¡QUIERO VER MÁS!</button>
        

    </section>
    
    <section id="product1" class="section-p1">
        <p>NUEVOS PRODUCTOS</p>
        <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php foreach ($resultado as $row) {?>
        <div class="col">
          <div class="card shadow-sm">    
                <?php
                $id = $row['id'];
                $imagen = "IMG/products/" . $id . "/principal.png";
                if (!file_exists($imagen)) {
                    $imagen = "IMG/products/no-photos.jpg";
                }
                ?>
             <img src="<?php echo $imagen;?>" alt="">
            <div class="card-body">
              <h5 class="card-tittle"><?php echo $row['nombre'];?></h5>
                <p class="card-text">S/<?php echo number_format($row['precio'],2,'.',',');?></p>
                <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a href="details.php?id=<?php echo $row['id'];?>&token=<?php 
                  echo hash_hmac('sha1',$row['id'], KEY_TOKEN);?>" class="btn btn-primary">Detalle</a> 
                </div>
                <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'],KEY_TOKEN); ?>')">Agregar al carrito</button>
              </div>  
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
</div>
    </section>


</a>
         </div>
        <a href="https://m.me/Petcatdog"  target="_blank"><div class="banner-box banner-box2" ></a>
        </div>
    </section>

    <section id="newsletter"  class="section-p1 section-m1">
        <div class="newstext">
 
        <div class="form" >

        </div>
        </form>
    </section>

    <footer class="section-p1">
        <div class="col">
            
            <h4>ENCUENTRANOS</h4>
            <p><strong><i class="fa fa-location"></i>¿DONDE ESTAMOS?: </strong>Av. Miguel Grau 15033-Ayacucho
            </p>
            <p><strong><i class="fa fa-outdent"></i>HORARIO DE ATENCIÓN: </strong>Lunes a Viernes: 7am a 8pm/Sabado: 9am a 6pm</p>
            <p><strong><i class="fa fa-phone"></i>TELEFONO: </strong>943 546 466/945 233 124</p>
            <p><strong><i class="fa fa-envelope"></i>CORREO: </strong>samycareful@gmail.com</p>
            <div class="follow">
                <h4>SÍGUENOS EN NUESTRAS REDES</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    
                </div>
            </div>
        </div>
        <center>
            <div class="col install">
    
                <p></p>
                <img src="IMG/huella.png" alt="">
        
            </center>
       
        <div class="copyright">
            <p>2024 Samipet.pe - Todos los derechos reservados - Diseño Web</p>
        </div>
        
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
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