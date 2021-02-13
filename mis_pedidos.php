<?php

    session_start();
    require_once __DIR__ . '/vendor/autoload.php';

    error_reporting(0);

    if(isset($_SESSION['usuario'])){

        $correo = $_SESSION['usuario'];

        $C_clientes = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->clientes; 
        $datosC = $C_clientes->findOne(['correo' => $correo]);

        $nombre = $datosC['nombre'];
        $ape1 = $datosC['ape1'];

        $C_pedidos = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->pedidos; 
        $datosP = $C_pedidos->findOne(['correo' => $correo]);

        $C_productos = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->productos; 
        $datosPr = $C_productos->findOne(['codigo' => "111"]);

        $nombre_p = $datosPr['nombre'];
        $precio = $datosPr['precio'];
        $cantidad = $datosP['cantidad'];
        $total = $datosP['total'];
        $fecha_hora = $datosP['fecha_hora'];

        if ($datosP['cantidad'] == null && $total = $datosP['total'] == null && $datosP['fecha_hora'] == null) {
            $nombre_p = 'Sin pedidos';
            $precio = 'Sin pedidos';
            $cantidad = 'Sin pedidos';
            $total = 'Sin pedidos';
            $fecha_hora = 'Sin pedidos';
        }



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos_responsivo.css">
    <script src="js/scrollreveal.js"></script>
    <link rel="shortcut icon" href="img/favicon.jpg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&display=swap" rel="stylesheet">
</head>
<body class="body-perfil">

    <?php include "partes/_navs.php"; ?>

    <section id="perfil">
        
        <h1 class="h1-perfil">Mis pedidos</h1>
        
        <div class="div-inputs-perfil-gnrl">                
            <div class="div-inputs-perfil">
                <label for="nombre" id="label-perfil">Nombre del producto</label>
                <br>
                <input class="input-perfil-form" type="text" value="<?php echo $nombre_p?>" disabled>                
            </div>

            <div class="div-inputs-perfil">
                <label for="precio" id="label-perfil">Precio del producto</label>
                <br>
                <input class="input-perfil-form" type="text" value="<?php echo $precio?>" disabled>
            </div>

            <div class="div-inputs-perfil">
                <label for="cantidad" id="label-perfil">Cantidad comprada hasta el momento</label>
                <br>
                <input class="input-perfil-form" type="text" value="<?php echo $cantidad?>" disabled>
            </div>

            <div class="div-inputs-perfil">
                <label for="precio_total" id="label-perfil">Precio total de la compra hasta el momento</label>
                <br>
                <input class="input-perfil-form" type="text" value="<?php echo $total?>" disabled>
            </div>

            <div class="div-inputs-perfil">
                <label for="fecha_hora" id="label-perfil">Fecha y hora de la última compra</label>
                <br>
                <input class="input-perfil-form" type="text" value="<?php echo $fecha_hora?>" disabled>
            </div>

        </div>

        <div class="div-perfil-btn">
            <a class="btn-perfil" href="mi_perfil.php">Volver atrás</a>
            <a class="btn-perfil" href="index.php">Volver al inicio</a>
        </div>

    </section>

    
    <script src="https://kit.fontawesome.com/56b0f801ce.js" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>

<?php

    }

?>