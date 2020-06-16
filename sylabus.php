<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema Educativo</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <!--  Scripts-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</head>

<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="index.php" class="brand-logo">
                <img src="imagenes/cesca.png" width="130px">
            </a>
            <ul class="right hide-on-med-and-down">
                <li class="scroll active"><a href="sylabus.php">Sylabus </a></li>
                <li class="scroll"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li class="scroll active"><a href="index.php">Inicio </a></li>
                <li class="scroll"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>


    <div class="container">

        <div class="container">
            <h2 class="center -text"><U>DESCARGUE SYLABUS</U></h2>
        </div>


        <div class="center">

            <h5><a href="https://drive.google.com/open?id=10oPUxIBU0S8pz5-5xRT1W3pVUyKPmOoN" target="_blank">COMPUTACIÓN
                    E INFORMÁTICA.RAR</a></h5>

            <h5><a href="https://drive.google.com/open?id=1brRtB29QXNHEffg5WakS4dAfMFJZ_7k1"
                    target="_blank">CONTABILIDAD.RAR</a></h5>

            <h5><a href="https://drive.google.com/open?id=1l-d2I6qh0m7846gobIXPpcbBY-oZBes9"
                    target="_blank">ADMINISTRACIÓN DE EMPRESAS.RAR</a></h5>

        </div>






        <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="imagenes/computacion.png"></a>
            <a class="carousel-item" href="#two!"><img src="imagenes/contabilidad.png"></a>
            <a class="carousel-item" href="#three!"><img src="imagenes/administracion_empresas.png"></a>
        </div>

        <script>
        // Or with jQuery

        $(document).ready(function() {
            $('.carousel').carousel();
        });
        </script>



    </div>


    </div>




    <?php
include "pie.php";
?>