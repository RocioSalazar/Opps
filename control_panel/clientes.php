<?php

    session_start();
    error_reporting(0);

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, '');
    $dia=date('d');
    $mes=strftime('%B');
    $anio=date('Y');
    $fecha=$dia . ' de ' . $mes . ' del ' . $anio;

    require_once '../vendor/autoload.php';
    $clientes = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->clientes; 
    $datos = $clientes->find();


    $i=0;

    if(isset($_SESSION['admin'])){

        $correo = $_SESSION['admin'];

        $C_administradores = (new MongoDB\Client('mongodb+srv://javier:javier12345@cluster0.w3wdi.mongodb.net/opss?retryWrites=true&w=majority'))->opss->administradores; 
        $admin = $C_administradores->findOne(['correo' => $correo]);

        if ($correo == "root@gmail.com") {
            $nombre = "usuario";
            $ape1 = $admin['nombres']['nombre'];
        }else{
            $nombre = $admin['nombres']['nombre'];
            $ape1 = $admin['nombres']['ape1'];
        }

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../img/favicon1.png">
    <!-- Estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/estilos_panel.css" rel="stylesheet">
    <title>Clientes</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <?php include_once "views/navBar_lateral.php"?>
        <!-- Fin Barra lateral -->

        <!-- Contenido completo -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Barra sueperior -->
            <?php include_once "views/navBar_superior.php"?>
            <!-- Fin de Barra sueperior -->
            
            <!-- Contenido central -->
            <div id="content">
                <div class="container-fluid">

                    <!-- Titulo -->
                    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>

                    <!-- Tabla Administradores -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabla de clientes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                    <thead>
                                        <th>No.</th>
                                        <th>Nombre</th>
                                        <th>Primer Apellido</th>
                                        <th>Segundo Apellido</th>
                                        <th>Calle</th>
                                        <th>Número</th>
                                        <th>Col o Fracc.</th>
                                        <th>CP</th>
                                        <th>Ciudad</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </thead>
                                
                                <?php
                                    foreach ($datos as $dato) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i=$i+1 ?></td>
                                            <td><?php echo $dato['nombres']["nombre"]; ?></td>
                                            <td><?php echo $dato['nombres']["ape1"]; ?></td>
                                            <td><?php if ($dato['nombres']["ape2"]) {
                                                echo $dato['nombres']["ape2"];
                                            }else{
                                                echo "-";
                                            } ?></td>
                                            <td><?php echo $dato['direccion']["calle"]; ?></td>
                                            <td><?php echo $dato['direccion']["numero"]; ?></td>
                                            <td><?php echo $dato['direccion']["col_fracc"]; ?></td>
                                            <td><?php echo $dato['direccion']["cp"]; ?></td>
                                            <td><?php echo $dato['direccion']["ciudad"]; ?></td>
                                            <td><?php echo $dato["telefono"]; ?></td>
                                            <td><?php echo $dato["correo"]; ?></td>
                                            <td><a id="btn-panel" class="btn btn-danger" href="eliminar.php?id_cliente=<?php echo $dato['_id']?>" onclick="return ConfirmDelete()"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>

                                        <?php
                                            }//foreach
                                        ?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Contenido central -->

            <!-- Footer -->
                <?php include_once "views/footer.php" ?>
            <!-- Fin de Footer -->
        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- funcionamiento de datatables -->
    <script type="text/javascript" src="../datatable/datatables.min.js"></script>
    <script type="text/javascript" src="../datatable/Responsive-2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <!-- botones de datatables -->
    <script type="text/javascript" src="../datatable/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../datatable/JSZIP-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../datatable/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../datatable/pdfmake-0.1.36/vsf_fonts.js"></script>
    <script type="text/javascript" src="../datatable/Buttons-1.6.2/js/buttons.html5.min.js"></script>
    <!-- funcionamiento de eliminación de registros (propios) -->
    <script type="text/javascript" src="../js/eliminar.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>


</html>

<?php

    }elseif(isset($_SESSION['estandar'])){

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../img/favicon1.png">
    <!-- Estilos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/estilos_panel.css" rel="stylesheet">
    <title>Clientes</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Barra lateral -->
        <?php include_once "views/navBar_lateral.php"?>
        <!-- Fin Barra lateral -->

        <!-- Contenido completo -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Barra sueperior -->
            <?php include_once "views/navBar_superior.php"?>
            <!-- Fin de Barra sueperior -->
            
            <!-- Contenido central -->
            <div id="content">
                <div class="container-fluid">

                    <!-- Titulo -->
                    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>

                    <!-- Tabla Administradores -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabla de clientes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                    <thead>
                                        <th>No.</th>
                                        <th>Nombre</th>
                                        <th>Primer Apellido</th>
                                        <th>Segundo Apellido</th>
                                        <th>Calle</th>
                                        <th>Número</th>
                                        <th>Col o Fracc.</th>
                                        <th>CP</th>
                                        <th>Ciudad</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                    </thead>
                                
                                <?php
                                    foreach ($datos as $dato) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i=$i+1 ?></td>
                                            <td><?php echo $dato['nombres']["nombre"]; ?></td>
                                            <td><?php echo $dato['nombres']["ape1"]; ?></td>
                                            <td><?php if ($dato['nombres']["ape2"]) {
                                                echo $dato['nombres']["ape2"];
                                            }else{
                                                echo "-";
                                            } ?></td>
                                            <td><?php echo $dato['direccion']["calle"]; ?></td>
                                            <td><?php echo $dato['direccion']["numero"]; ?></td>
                                            <td><?php echo $dato['direccion']["col_fracc"]; ?></td>
                                            <td><?php echo $dato['direccion']["cp"]; ?></td>
                                            <td><?php echo $dato['direccion']["ciudad"]; ?></td>
                                            <td><?php echo $dato["telefono"]; ?></td>
                                            <td><?php echo $dato["correo"]; ?></td>
                                        </tr>
                                    </tbody>

                                        <?php
                                            }//foreach
                                        ?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Contenido central -->

            <!-- Footer -->
                <?php include_once "views/footer.php" ?>
            <!-- Fin de Footer -->
        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- funcionamiento de datatables -->
    <script type="text/javascript" src="../datatable/datatables.min.js"></script>
    <script type="text/javascript" src="../datatable/Responsive-2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <!-- botones de datatables -->
    <script type="text/javascript" src="../datatable/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../datatable/JSZIP-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../datatable/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../datatable/pdfmake-0.1.36/vsf_fonts.js"></script>
    <script type="text/javascript" src="../datatable/Buttons-1.6.2/js/buttons.html5.min.js"></script>
    <!-- funcionamiento de eliminación de registros (propios) -->
    <script type="text/javascript" src="../js/eliminar.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>


</html>

<?php

    }elseif (isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {

        header("Location: ../index.php");
        
    }

?>