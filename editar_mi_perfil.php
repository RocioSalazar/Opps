<?php

    session_start();

    require_once __DIR__ . '/vendor/autoload.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!empty($_POST['id'])&&!empty($_POST['nombre'])&&!empty($_POST['ape1'])&&!empty($_POST['calle'])&&!empty($_POST['numero'])&&!empty($_POST['col_fracc'])&&!empty($_POST['cp'])&&!empty($_POST['telefono'])){

            $id_edit = $_POST['id'];
            $nombre_edit = $_POST['nombre'];
            $ape1_edit = $_POST['ape1'];
            $ape2_edit = $_POST['ape2'];
            $calle_edit = $_POST['calle'];
            $numero_edit = $_POST['numero'];
            $col_fracc_edit = $_POST['col_fracc'];
            $cp_edit = $_POST['cp'];
            $telefono_edit = $_POST['telefono'];

            $C_clientes = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->clientes;

            $edit_cliente = $C_clientes -> updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($id_edit)],
                ['$set' => ['nombre' => $nombre_edit, 'ape1' => $ape1_edit, 'ape2' => $ape2_edit, 'calle' => $calle_edit, 'numero' => $numero_edit, 'col_fracc' => $col_fracc_edit, 'cp' => $cp_edit, 'telefono' => $telefono_edit]]
            );

            if ($edit_cliente) {
                echo "<script>alert('Su perfil se editó con exito')</script>";
                echo "<script> location.href='mi_perfil.php' </script>";
            }

        }else{
            echo "<script>alert('Ingrese todos los campo')</script>";
        }

    }

    if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){

        header("Location: control_panel/index.php");
      
    }elseif (!isset($_SESSION['usuario'])) {

        header("Location: index.php");
        
    }elseif (isset($_SESSION['usuario'])) {

        $correo = $_SESSION['usuario'];

        $C_clientes = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->clientes; 
        $datos = $C_clientes->findOne(['correo' => $correo]);

        $id = $datos['_id'];
        $nombre = $datos['nombre'];
        $ape1 = $datos['ape1'];
        $ape2 = $datos['ape2'];
        $calle = $datos['calle'];
        $numero = $datos['numero'];
        $col_fracc = $datos['col_fracc'];
        $cp = $datos['cp'];
        $telefono = $datos['telefono'];
        $correo = $datos['correo'];
        

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos_responsivo.css">
    <script src="js/scrollreveal.js"></script>
    <link rel="shortcut icon" href="img/favicon.jpg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&display=swap" rel="stylesheet">
</head>
<body class="body-perfil">
    
    <?php include "partes/_navs.php" ?>

    <section id="perfil">
        
        <h1 class="h1-perfil">Mi perfil</h1>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div class="div-inputs-perfil-gnrl">
                <div class="div-inputs-perfil">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="div-inputs-registrar2">                      
                        <label for="nombre" id="label-perfil">Nombre(s)</label>
                    </div>
                    <input class="input-perfil-form" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="nombre" required id="nombre" value="<?php echo $nombre?>">
                </div>
                
                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">                
                        <label for="ape1" id="label-perfil">Primer apellido</label>
                    </div>
                    <input class="input-perfil-form" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="ape1" required id="ape1" value="<?php echo $ape1?>">                
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">
                        <label for="ape2" id="label-perfil">Segundo apellido</label>
                    </div>
                    <input class="input-perfil-form" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="ape2" id="ape2" value="<?php echo $ape2?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">
                        <label for="telefono" id="label-perfil">Teléfono</label>
                    </div>
                    <input class="input-perfil-form" title="Solo números" pattern="[0-9]+" type="tel" name="telefono" required id="telefono" minlength="10" maxlength="10" value="<?php echo $telefono?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">
                        <label for="calle" id="label-perfil">Calle</label>
                    </div>
                    <input class="input-perfil-form" type="text" name="calle" required id="calle" value="<?php echo $calle?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2"> 
                        <label for="numero" id="label-perfil">Número exterior</label>
                    </div>                    
                    <input class="input-perfil-form" type="text" name="numero" required id="numero" value="<?php echo $numero?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">
                        <label for="col-fracc" id="label-perfil">Col. o Fracc.</label>
                    </div>
                    <input class="input-perfil-form" type="text" name="col_fracc" required id="col-fracc" value="<?php echo $col_fracc?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">     
                        <label for="cp" id="label-perfil">Código Postal</label>
                    </div>                
                    <input class="input-perfil-form" type="tel" title="Solo números" maxlength="5" pattern="[0-9]+" name="cp" required id="cp" value="<?php echo $cp?>">
                </div>

                <div class="div-inputs-perfil">
                    <div class="div-inputs-registrar2">
                        <label for="email" id="label-perfil">Email</label>
                    </div>
                    <input class="input-perfil-form" type="text" name="correo" required id="email" value="<?php echo $correo?>" disabled>
                </div>

            </div>

            <div class="div-btns-editar">
                <input class="btn-input-perfil" type="submit" value="Guardar cambios">
                <a class="btn-editar-perfil2" href="mi_perfil.php"><input class="btn-input-perfil2" type="button" value="Volver atrás" ></a>
                <a class="btn-editar-perfil2" href="index.php"><input class="btn-input-perfil2 btn-input-perfil2-2" type="button" value="Volver al inicio"></a>
            </div>

        </form>
    </section>

    <script src="https://kit.fontawesome.com/56b0f801ce.js" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>

<?php

    }

?>