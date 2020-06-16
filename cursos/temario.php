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
    <?php
    session_start();
    include "../conexion.php";
    include "../edit-profile.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $semana = isset($_POST['semana']) ? $_POST['semana'] : "";
    $curso = isset($_GET['curso']) ? $_GET['curso'] : "";
    $selected = "";
    $j3 = 0;
    ?>



    <div class="container">
        <form action="temario.php" method="get">
        
          
            <select class="browser-default" name="curso">
                <?php
                $select3 = "Select c.cod_curso,c.Descripcion,s.descripcion from curso c,sub_linea s,publicacion p where c.Cod_sublinea = s.Cod_sublinea  
     and p.cod_curso=c.cod_curso and s.cod_linea='001' and s.cod_marca ='01'
     group by c.Descripcion
      order by c.descripcion asc";
                $query3 = (mysqli_query($conn, $select3));
                $registro3 = mysqli_num_rows($query3);
                while ($j3 < $registro3) {
                    $row3 = mysqli_fetch_array($query3);
                    $Cod3 = $row3[0];
                    $Descripcion3 = $row3[1] . " " . $row3[2];
                    if ($curso == $Cod3) {
                        $selected = "selected";
                    }

                    echo "<option value='$Cod3' $selected>$Descripcion3</option>";
                    $selected = "";
                    $j3++;
                }
                ?>
            </select>

            <p></p>
            <button class="btn waves-effect waves-light" type="submit" name="action" value="Buscar">Buscar
                <i class="material-icons right">send</i>
            </button>
        </form>


        <div class="row">

<div class="col s12 m6">
        <?php
        if ($action == "Buscar") {
            $query_esp = (mysqli_query($conn, "call publicacion_search('$curso')"));
            $fila2 = mysqli_num_rows($query_esp);
            echo "<p></p>";
            $z2 = 0;

            while ($z2 < $fila2) {
                $r2 = mysqli_fetch_array($query_esp);
                echo "<h6><a href='tema.php?tema=".$r2[0] . "'>".$r2[6]."</a></h6>";
                echo "<p></p>";
                //////////////////////////////////////////////////////////////////////////////////////////
            
                $z2++;
            }
        }
        ?>

</div>
<div class="col s12 m6">
    
<div class="fb-comments" data-href="http://educativocesca.000webhostapp.com/index.php" data-width="100%" data-numposts="3" data-order-by="reverse_time"></div>
</div>

</div>


    </div>

    <?php
    include "../pie.php";
    ?>