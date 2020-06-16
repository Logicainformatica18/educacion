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
    <p></p>
    <?php
    session_start();
    include "../conexion.php";
    include "../edit-profile.php";
   
    ?>
    <div class="container">

        <h5><b>ELIGE EL CURSO QUE QUIERES APRENDER HOY...</b></h5> <BR>
        <div class="center">
            <?php
            $select3 = "Select c.cod_curso,c.Descripcion,s.descripcion from curso c,sub_linea s,publicacion p where c.Cod_sublinea = s.Cod_sublinea  
and p.cod_curso=c.cod_curso and s.cod_linea='001' and s.cod_marca ='01'
group by c.Descripcion
order by c.descripcion asc";
            $query = mysqli_query($conn, $select3);
            while ($r = mysqli_fetch_array($query)) {
                echo "<h6><a href='temario.php?curso=" . $r[0] . "&action=Buscar'>" . $r[1] . "</a></h6>";
            };
            ?>
        </div>



    </div>






    <?php
    include "../pie.php";
    ?>