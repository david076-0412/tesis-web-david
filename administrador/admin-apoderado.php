<?php


include "../conexion.php";

session_start();


if (isset($_SESSION['usuario'])) {
} else {
    header('Location: ../login.php'); // Redireccionar al formulario de inicio de sesión si no ha iniciado sesión

    exit();
}

?>





<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Apoderado</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../administrador/css/bootstrap.minsl.css">
    <!----css3---->
    <link rel="stylesheet" href="../administrador/css/custom.css">


    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="../administrador/images/logotiposbp.ico" type="image/x-icon" rel="shortcut icon" />
    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">


    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="../administrador/images/logotiposbp.ico" type="image/x-icon" rel="shortcut icon" />





    <link href="../DataTables/datatables.min.css" rel="stylesheet">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />



    <style>
        h1,
        h2,
        h4 {

            text-transform: none;
            /* Esta propiedad quita cualquier transformación del texto */

        }


        td {

            text-transform: none;
            /* Esta propiedad quita cualquier transformación del texto */

        }

        table {
            width: 100%;
            text-align: center;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        select {
            padding: 10px 5px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid #ededed;
            color: #1b1b1b;
            outline: none;
        }
    </style>





</head>

<body>




    <div class="wrapper">

        <div class="body-overlay"></div>

        <!-------sidebar--design------------>

        <div id="sidebar">
            <div class="sidebar-header">
                <h3><img src="../administrador/images/logoCPSBP.png" class="img-fluid" /><span>I.E.P SBP MIXTO</span></h3>
            </div>
            <ul class="list-unstyled component m-0">




                <li class="dropdown">
                    <a href="../administrador/panel_admin.php?usuario=<?php
                                                                        $usuario = $_SESSION['usuario'];
                                                                        echo "$usuario"; ?>" class="dashboard"><i class="material-icons">school</i>
                        Colegio</a>
                </li>





                <li class="dropdown">


                    <a href="../administrador/admin-docente.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                        echo "$usuario"; ?>" class="dashboard"><i class="material-icons">work</i>
                        Docentes</a>


                </li>



                <li class="active">
                    <a href="../administrador/admin-apoderado.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                            echo "$usuario"; ?>" class="dashboard"><i class="material-icons">portrait</i>
                        Apoderados</a>
                </li>



                <li class="dropdown">

                    <a href="../administrador/admin-horario.php?usuario=<?php
                                                                        $usuario = $_SESSION['usuario'];
                                                                        echo "$usuario"; ?>" class="dashboard"><i class="material-icons">schedule</i>
                        Horarios</a>



                </li>






                <li class="dropdown">



                <a href="../administrador/admin-pagos.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                        echo "$usuario"; ?>" class="dashboard"><i class="material-icons">date_range</i>
                        Pagos</a>


                </li>


                <li class="dropdown">


                <?php $usuario = $_SESSION['usuario']; ?>
                    <a href="../administrador/admin-reporte.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                        echo "$usuario"; ?>&nivel=<?php
                                                                                                                                            if ($usuario == "adminprimaria") {
                                                                                                                                                echo "Primaria";
                                                                                                                                            } else if ($usuario == "adminsecundaria") {
                                                                                                                                                echo "Secundaria";
                                                                                                                                            }


                                                                                                                                            ?>" class="dashboard"><i class="material-icons">equalizer</i>
                        Reportes</a>






                </li>




            </ul>
        </div>

        <!-------sidebar--design- close----------->



        <!-------page-content start----------->

        <div id="content">

            <!------top-navbar-start----------->

            <div class="top-navbar">
                <div class="xd-topbar">
                    <div class="row">
                        <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <span class="material-icons text-white">signal_cellular_alt</span>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-3 order-3 order-md-2">

                        </div>


                        <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                            <div class="xp-profilebar text-right">
                                <nav class="navbar p-0">
                                    <ul class="nav navbar-nav flex-row ml-auto">




                                        <li class="dropdown nav-item">



                                            <?php


                                            include('../conexion.php');

                                            $usuario = $_REQUEST['usuario'];


                                            $query = "SELECT perfil,usuario FROM admin WHERE usuario ='$usuario'";

                                            $resultado = mysqli_query($conexion, $query); // Asegúrate de tener una conexión establecida antes de ejecutar la consulta
                                            $fila = mysqli_fetch_assoc($resultado);


                                            ?>



                                            <?php

                                            $imagen_perfil = $fila['perfil'];


                                            if ($imagen_perfil != NULL) {
                                            ?>



                                                <a class="nav-link" href="#" data-toggle="dropdown">
                                                    <img src="data:image/jpeg;base64,<?= base64_encode($fila['perfil']) ?>" style="width:40px; border-radius:50%;" />
                                                    <span class="xp-user-live"></span>
                                                </a>



                                            <?php

                                            } else {
                                            ?>

                                                <a class="nav-link" href="#" data-toggle="dropdown">
                                                    <img src="../administrador/images/user.png" style="width:40px; border-radius:50%;" />
                                                    <span class="xp-user-live"></span>
                                                </a>

                                            <?php

                                            }

                                            ?>







                                            <ul class="dropdown-menu small-menu">
                                                <li><a href="../administrador/admin-perfil.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                                        echo "$usuario"; ?>">
                                                        <span class="material-icons">person_outline</span>
                                                        Perfil
                                                    </a></li>

                                                <li><a href="../logout.php">
                                                        <span class="material-icons">logout</span>
                                                        Cerrar Sesion
                                                    </a></li>

                                            </ul>
                                        </li>







                                    </ul>
                                </nav>
                            </div>
                        </div>





                    </div>




                    <div class="xp-breadcrumbbar text-center">
                        <h4 class="page-title">Apoderado</h4>

                        <ol class="breadcrumb">

                            <!--
					<li class="breadcrumb-item"><a href="listarcursosalumnos.php">Cursos</a></li>
					<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					-->

                        </ol>
                    </div>





                </div>
            </div>
            <!------top-navbar-end----------->


            <!------main-content-start----------->

            <div class="main-content">


                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoapoderado">
                    Nuevo Apoderado

                </button>

                <?php include("../administrador/Modal/ModalNuevoApoderado.php") ?>


                <div class="col-md-12">


                    <?php

                    include('../conexion.php');


                    ?>








                    <?php

                    $usuario = $_SESSION['usuario'];



                    $sqlClienteff   = ("SELECT DISTINCT ap.id,ap.apellido_paterno,ap.apellido_materno,ap.nombres,ap.tipo_documento,ap.dni,ap.usuario,ap.estado_foto,ap.foto_do_identidad,ap.correo,ap.password
                    FROM apoderado ap
                    ORDER BY ap.apellido_paterno ASC");
                    $queryClienteff = mysqli_query($conexion, $sqlClienteff);
                    $cantidad     = mysqli_num_rows($queryClienteff);

                    ?>



                    <br>

                    <div class="row clearfix">



                        <div class="table-responsive">



                            <table id="example" class="table-bordered table-hover" style="width:100%">


                                <thead>
                                    <tr>
                                        <td style="width:120px; background-color: #5DACCD; color:#fff">Apoderado</td>
                                        <td style="width:120px; background-color: #5DACCD; color:#fff">Documento de Identidad</td>
                                        <td style="width:70px; background-color: #5DACCD; color:#fff">Alumno</td>
                                        <td style="width:90px; background-color: #5DACCD; color:#fff">Alumno_Soli</td>
                                        <td style="width:120px; background-color: #5DACCD; color:#fff">Documento de Identidad en PDF</td>
                                        <th style="width:160px; background-color: #5DACCD; color:#fff">Accion</th>
                                    </tr>
                                </thead>

                                <tbody>



                                    <?php while ($data = mysqli_fetch_array($queryClienteff)) { ?>




                                        <tr>
                                            <td>
                                                <?php echo $data['apellido_paterno'] ?> <?php echo $data['apellido_materno'] ?> <?php echo $data['nombres'] ?>
                                            </td>

                                            <td>
                                                <?php echo $data['tipo_documento'] ?>: <?php echo $data['dni'] ?>
                                            </td>


                                            <td>
                                                <a href="../administrador/admin-alumno.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                                    echo $usuario ?>&usuario_apoderado=<?php echo $data['usuario'] ?>&usuario_dni_apoderado=<?php echo $data['dni'] ?>&usuario_nombre_apoderado=<?php echo $data['apellido_paterno'] ?> <?php echo $data['apellido_materno'] ?> <?php echo $data['nombres'] ?>">

                                                    <span class="material-symbols-outlined">
                                                        person_celebrate
                                                    </span>
                                                </a>


                                            </td>

                                            <td>


                                                <a href="../administrador/admin-solicitud.php?usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                                        echo $usuario ?>&usuario_apoderado=<?php echo $data['usuario'] ?>">

                                                    <span class="material-symbols-outlined">
                                                        receipt_long
                                                    </span>
                                                </a>
                                            </td>






                                            <td>


                                                <?php

                                                $estado_foto = $data['estado_foto'];

                                                if ($estado_foto == "SIN SUBIR") {

                                                ?>
                                                    <a href="#" id="verfoto_iden">
                                                        <img src="../administrador/images/archivo_pdf.png" style="width:80px; border-radius:50%;" alt="PDF">
                                                    </a>

                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                                                    <script>
                                                        document.getElementById('verfoto_iden').addEventListener('click', function(e) {
                                                            e.preventDefault();

                                                            Swal.fire({
                                                                title: "Falta Archivo",
                                                                confirmButtonText: "Aceptar",
                                                            });
                                                        });
                                                    </script>



                                                <?php

                                                } else if ($estado_foto == "SUBIDO") {
                                                ?>




                                                    <a href="../administrador/mostrar_foto_iden.php?id=<?php echo $data['id'] ?>&usuario_apoderado=<?php echo $data['usuario'] ?>&usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                                                                                                                            echo $usuario; ?>" target="_blank">
                                                        <img src="../administrador/images/archivo_pdf.png" alt="Logo" width="80" height="80">
                                                    </a>

                                                <?php

                                                }
                                                ?>




                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarapoderado<?php echo $data['id']; ?>">
                                                    <span class="material-icons">edit</span>

                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verapoderado<?php echo $data['id']; ?>">
                                                    <span class="material-icons">search</span>

                                                </button>

                                                <a href="../administrador/eliminarapoderado.php?id=<?php echo $data['id']; ?>&usuario=<?php $usuario = $_SESSION['usuario'];
                                                                                                                                        echo $usuario; ?>&usuario_apoderado=<?php echo $data['usuario'] ?>">
                                                    <button type="button" class="btn btn-danger">
                                                        <span class="material-icons">delete</span>

                                                    </button>
                                                </a>



                                            </td>


                                        </tr>

                                        <!--Ventana Modal para Actualizar--->
                                        <?php include('../administrador/Modal/ModalEditarApoderado.php'); ?>

                                        <!--Ventana Modal para Actualizar--->
                                        <?php include('../administrador/Modal/ModalVerApoderado.php'); ?>


                                    <?php } ?>


                            </table>

                        </div>

                    </div>






                </div>





            </div>








        </div>

    </div>



    <!-------complete html----------->






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../administrador/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../administrador/js/popper.min.js"></script>
    <script src="../administrador/js/bootstrap.min.js"></script>
    <script src="../administrador/js/jquery-3.3.1.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script src="../DataTables/datatables.min.js"></script>




    <script src="../administrador/package/dist/sweetalert2.all.js"></script>
    <script src="..administrador/package/dist/sweetalert2.all.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>





    <script src="../administrador/js/scriptalertapoderado.js"></script>





    <script>
        $(document).ready(function() {
            $('#example').DataTable({


                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },


                "searching": true,
                "columns": [
                    null, // Columna 1
                    null, // Columna 2
                    null, // Columna 3
                    null, // Columna 4
                    null, // Columna 5
                    null, // Columna 6



                    // ... Agrega null para cada columna
                ]
            });
        });
    </script>
















    <script type="text/javascript">
        $(document).ready(function() {
            $(".xp-menubar").on('click', function() {
                $("#sidebar").toggleClass('active');
                $("#content").toggleClass('active');
            });

            $('.xp-menubar,.body-overlay').on('click', function() {
                $("#sidebar,.body-overlay").toggleClass('show-nav');
            });

        });
    </script>





</body>

</html>