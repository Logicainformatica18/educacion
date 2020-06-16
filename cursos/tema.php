<?php
    session_start();
    include "../conexion.php";
    include "../edit-profile.php";
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $semana = isset($_POST['semana']) ? $_POST['semana'] : "";
    $tema = isset($_GET['tema']) ? $_GET['tema'] : "";
    $selected = "";
    $j3 = 0;
    if($tema!="") {

        $query_esp = (mysqli_query($conn, "SELECT * FROM publicacion where cod_publicacion='$tema';"));
      
            $r2 = mysqli_fetch_assoc($query_esp);
       
         //   
        }   
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema Educativo</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />


    <!--  Scripts-->
    <script src="../js/jquery-2.1.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>
</head>
<!--/head-->

<body>
    <!--  -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v4.0">
    </script>
    <!--  -->
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
        <a id="logo-container" href="../index.php" class="brand-logo">
                <img src="../imagenes/cesca.png" width="90px">
            </a>
            <ul class="right hide-on-med-and-down">
                <li class="scroll"><a href="../alumno.php">Alumno </a></li>
                <li class="scroll active"><a href="alumno_publicaciones.php">Biblioteca</a></li>
                <li class="scroll"><a href="../chat.php">Chat</a></li>
                <li class="scroll"><a href="../notas.php">Registro</a></li>
                <li class="scroll"><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
            <ul id="nav-mobile" class="sidenav">
                <li class="scroll"><a href="../index.php">Inicio </a></li>
                <li class="scroll"><a href="../alumno.php">Alumno </a></li>
                <li class="scroll active"><a href="alumno_publicaciones.php">Biblioteca</a></li>
                <li class="scroll"><a href="../notas.php">Notas</a></li>
                <li class="scroll"><a href="../chat.php">Chat</a></li>
                <li class="scroll"><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    
        <div class="row" style="margin-left: -12px;">
            <div class="col s12 m9" style="margin-top: -25px;">
                <?php
                // TEMAS
            echo $r2['mensaje'];
          
   
                ?>

            </div>
            <div class="col s12 m3">

            <?php
                                  // TITULO 
           echo "<div class='container'><h6 class='red-text'><b>".$r2['titulo']."</b></h6></div>";   
          
            ?>
           <pre>

           </pre>
                <div class="fb-comments" data-href="http://educativocesca.000webhostapp.com/index.php" data-width="100%"
                    data-numposts="10" data-order-by="reverse_time"></div>
            </div>

        </div>




    <?php
    include "../pie.php";
    ?>