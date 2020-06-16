<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Sistema Educativo</title>
  <!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/funciones.js"></script>
</head><!--/head-->
<body>

    
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
<li><a href="registro.php">Registro</a></li>
  <li class="divider"></li>
  <li class="scroll active"><a href="registro_mantenimiento.php">Mantenimiento</a></li>
</ul>
<!-- Dropdown Structure -->
<ul id="dropdown2" class="dropdown-content">
<li><a href="registro.php">Registro</a></li>
  <li class="divider"></li>
  <li class="scroll active"><a href="registro_mantenimiento.php">Mantenimiento</a></li>
</ul>
<!-- Dropdown Structure -->
<ul id="dropdown3" class="dropdown-content">
<li><a href="publicar.php">Publicar</a></li>
  <li class="divider"></li>
  <li class="scroll"><a href="publicar_mantenimiento.php">Mantenimiento</a></li>
</ul>
<!-- Dropdown Structure -->
<ul id="dropdown4" class="dropdown-content">
<li><a href="publicar.php">Publicar</a></li>
  <li class="divider"></li>
  <li class="scroll"><a href="publicar_mantenimiento.php">Mantenimiento</a></li>
</ul>
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo">
     <img src="imagenes/cesca.png" width="90px">
      </a>
      <ul class="right hide-on-med-and-down">
    
                         <li class="scroll"><a href="profesor.php">Profesor </a></li>
            
                        <li class="scroll"><a href="cursos.php">Cursos</a></li>
                <!-- Dropdown Trigger -->
                <li class="scroll"><a class="dropdown-trigger1" href="registro.php" data-target="dropdown1">Registro<i class="material-icons right">arrow_drop_down</i></a></li>
                <!-- Dropdown Trigger -->
                <li class="scroll"><a class="dropdown-trigger2" href="publicar.php" data-target="dropdown3">Publicar<i class="material-icons right">arrow_drop_down</i></a></li>
                
                        <li class="scroll"><a href="alumno_buscar.php">Buscar Alumno</a></li>
                      
                        <li class="scroll"><a href="logout.php">Cerrar Sesión</a></li>
                       
       </ul>
 <script>
 $(".dropdown-trigger1").dropdown();
  $(".dropdown-trigger2").dropdown();
</script>  



       <ul id="nav-mobile" class="sidenav">
                        <li class="scroll"><a href="index.php">Inicio </a></li>
                        <li class="scroll"><a href="profesor.php">Profesor </a></li>
                 <!-- Dropdown Trigger -->
                <li class="scroll"><a class="dropdown-trigger3" href="publicar.php" data-target="dropdown4">Publicar<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li class="scroll"><a href="cursos.php">Cursos</a></li>
                        <li class="scroll"><a class="dropdown-trigger4" href="registro.php" data-target="dropdown2">Registro<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li class="scroll"><a href="alumno_buscar.php">Buscar Alumno</a></li>
                   
                        <li class="scroll"><a href="logout.php">Cerrar Sesión</a></li>
                                                 <!-- Dropdown Trigger -->

     

        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>

<script>
 $(".dropdown-trigger3").dropdown();
  $(".dropdown-trigger4").dropdown();
</script>  

  </nav>