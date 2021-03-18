<?php

    session_start();

    require_once 'vendor/autoload.php';
    

    if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){

        header("Location: control_panel/index.php");
    
    }elseif(isset($_SESSION['usuario'])){

        header("Location: index.php");
    
    }elseif(!isset($_SESSION['usuario'])){

        if ($_SERVER["REQUEST_METHOD"] == "POST"){


            $C_clientes = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->clientes; 
            $C_admins = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->administradores; 

            if(!empty($_POST['correo'])&&!empty($_POST['contrasena'])){

                $correo = $_POST['correo'];
                $contrasena = MD5($_POST['contrasena']);

                $cuenta_cliente = $C_clientes->findOne(['correo' => $correo],['contrasena' => $contrasena]);


                $cuenta_admin = $C_admins->findOne(['correo' => $correo],['contrasena' => $contrasena]);
                
                if ($cuenta_admin==null && $cuenta_cliente==null ) {

                    echo "<script>alert('Usuario o contraseña incorrectos')</script>";

                }elseif ($cuenta_cliente!=null) {

                    $cliente = $C_clientes->findOne(['correo' => $correo]);        
                    $nombre_c = $cliente['nombres']['nombre'];
                    $ape1_c = $cliente['nombres']['ape1'];

                    echo "<script>alert('Bienvenido cliente $nombre_c $ape1_c ')</script>";
                    echo "<script> location.href='index.php'</script>";
                    $_SESSION['usuario']=$correo;

                }elseif(cuenta_admin!=null){
                    $administrador = $C_admins->findOne(['correo' => $correo]);
                    
                    if ($correo == "estandar@gmail.com" || $correo == "root@gmail.com") {
                        $nombre_a = "";
                        $ape1_a = $administrador['nombre'];
                    }else{
                        $nombre_a = $administrador['nombres']['nombre'];
                        $ape1_a = $administrador['nombres']['ape1'];
                    }

                    if ($administrador['tipo_admin']=='1' || $administrador['tipo_admin']==1) {
                        $_SESSION['admin']=$correo;
                    }elseif($administrador['tipo_admin']=='2' || $administrador['tipo_admin']==2){
                        $_SESSION['estandar']=$correo;
                    }
                    echo "<script>alert('Bienvenido admin $nombre_a $ape1_a ')</script>";
                    echo "<script> location.href='control_panel/index.php' </script>";
                }elseif ($cuenta_cliente==null || $cuenta_admin==null) {
                    echo "<script>alert('Usuario o contraseña incorrectos')</script>";
                }
            
            }
        }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="js/scrollreveal.js"></script>
    <link rel="shortcut icon" href="img/favicon1.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos_responsivo.css">
</head>

<body class="body-login">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <section id="iniciar-sesion">
            <a href="index.php" class="x-ancla">
                <h1 id="x-login">X</h1>
            </a>
            <h1 class="h1-login">Iniciar sesión</h1>
            <h4 class="h4-p">
                ¿Eres nuevo en este sitio? <a class="ancla-registrarse-login" href="registrarse.php">Regístrate</a>
            </h4>

            <div class="div-inputs-login">
                <label for="email" id="label-login">Email</label>
                <br>
                <input class="input-login-form" type="email" name="correo" required id="email" value="<?php if(isset($correo)) echo $correo?>">
            </div>
            <br>
            <div class="div-inputs-login">
                <label for="password" id="label-login">Contraseña</label>
                <br>
                <input class="input-login-form" type="password" name="contrasena" required id="password" minlength="8">
            </div>
            <br>
            <input class="btn-input-login" type="submit" value="Iniciar Sesión">
        </section>
    </form>

    <script src="js/index.js"></script>
</body>

</html>

<?php

    }

?>