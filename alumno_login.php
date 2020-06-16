<?php
// ESTA PARTE VERIFICA SI YA HA INICIADO SESION ENTONCES REDIRECCIONA A PROFESOR
session_start();
include 'conexion.php';	
$Cod_persona=isset($_SESSION['loggedin'])? $_SESSION['loggedin']:"";
//$password=	isset($_SESSION['alumno_clave'])? $_SESSION['alumno_clave']:"";
// Consulta enviada a la base de datos
if( $Cod_persona ==true)
{
    
        echo "<script type='text/javascript'>window.location='alumno.php';</script>";
   
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
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <link rel="stylesheet" type="text/css" href="css/alumno_login.css" />
    <link href="css/index.css" rel="stylesheet">

    <!--  Scripts-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</head>
<!--/head-->

<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo">
                <img src="imagenes/cesca.png" width="90px">
            </a>
            <ul class="right hide-on-med-and-down">
                <li class="scroll"><a href="index.php">Inicio </a></li>
                <li class="scroll active"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li class="scroll"><a href="index.php">Inicio </a></li>
                <li class="scroll active"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <div class="container" align="center">
        <div class="row">
            <form action="validar_cuenta.php" method="post">

                <h1>Iniciar Sesión</h1>
                <img src="imagenes/login.jpg">
                <p></p>

                <div class="input-field col s6">
                    <input id="last_name" type="number" class="validate" name="Cod_persona" required>
                    <label for="last_name">DNI</label>
                </div>
                <div class="input-field col s6">
                    <input id="password" type="password" name="password" class="validate" name="Cod_persona" required>
                    <label for="password">Contraseña</label>
                </div>
                <p></p>
                <input type="submit" value="Iniciar Sesion" class="btn">
                <br>
            </form>
            <p></p>
            ¿No tienes una cuenta?
            <a href="#registro_alumno">Registrarme</a>
        </div>
    </div>

    <div class="container" align="center">
        <p></p>
        <form action="registrar_alumno.php" method="POST" id="registro_alumno">
            <h1>REGISTRARME</h1>
            <div class="input-field col s6">
                <input id="txtdni" type="text" class="validate" name="txtdni" required>
                <label for="txtdni">Dni</label>
            </div>
            <div class="input-field col s6">
                <input id="txtcod_persona" type="number" class="validate" name="txtcod_persona" required>
                <label for="txtcod_persona">Código de Carnet</label>
            </div>

            <div class="input-field col s6">
                <input id="txtpaterno" type="text" class="validate" name="txtpaterno" required>
                <label for="txtpaterno">Apellido Paterno</label>
            </div>

            <div class="input-field col s6">
                <input id="txtmaterno" type="text" class="validate" name="txtmaterno" required>
                <label for="txtmaterno">Apellido Materno</label>
            </div>

            <div class="input-field col s6">
                <input id="txtnombres" type="text" class="validate" name="txtnombres" required>
                <label for="txtnombres">Nombres</label>
            </div>

            <div class="input-field col s6">
                <input id="txtdireccion" type="text" class="validate" name="txtdireccion" required>
                <label for="txtdireccion">Dirección</label>
            </div>

            <h5>Fecha de Nacimiento :</h5>

            <div class="row">
                <div class="col s4">
                    <select name="Dia" class="browser-default">
                        <option>Dia</option>
                        <?php 
			for($a=1;$a<=31;$a++)
			 {echo "<option value='$a'>".$a."</option>";} ?>
                    </select>

                </div>

                <div class="col s4">

                    <select name="Mes" class="browser-default">
                        <option>Mes</option>
                        <?php 
			$mes=array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
			for($b=1;$b<=12;$b++)
			 {echo "<option value='$b'>".$mes[$b]."</option>";} ?>
                    </select>

                </div>

                <div class="col s4">

                    <select name="Año" class="browser-default">
                        <option>Año</option>
                        <?php 
			$c=2019;
			while($c>=1905)
			 {
				
				 echo "<option value='$c'>".$c."</option>";
				 $c=$c-1;
			}
			 ?>
                    </select>
                </div>

            </div>

            <?php
		//	date_default_timezone_set('America/Lima');
			 // echo date('m/d/Y g:ia');
			// echo date('m/d/Y');
			?>

            <p></p>
            <div class="registro">
                Sexo :
                <label>
                    <input class="with-gap" name="rbsexo" type="radio" value="M" /><span>Masculino</span>
                </label>
                <label>
                    <input class="with-gap" name="rbsexo" type="radio" value="F" /><span>Femenino</span>
                </label>

            </div>

            <p></p>
            <div class="registro">
                <h5>ESTADO CIVIL :</h5>

                <select name="cbcivil" class="browser-default">
                    <option value="S">Soltero</option>
                    <option value="C">Casado</option>
                    <option value="D">Divorsiado</option>
                    <option value="V">Viudo</option>
                </select>

            </div>




            <div class="input-field col s6">
                <input id="txtcelular" type="text" name="txtcelular" required>
                <label for="txtcelular">Celular</label>
            </div>

            <div class="input-field col s6">
                <input id="txtclave" class="validate" type='password' name="txtclave" required>
                <label for="txtclave">Contraseña</label>
            </div>
            <div class="input-field col s6">
                <input id="txtclave2" class="validate" type='password' name="txtclave2" required>
                <label for="txtclave2">Repetir contraseña</label>
            </div>


            <div class="input-field col s6">
                <input id="txtcorreo" class="validate" type='email' name="txtcorreo" required>
                <label for="txtcorreo">Email</label>
            </div>

            <input type="submit" name="btnmodificar" value="Registrar" class="btn">
            <p>
                <p>
    </div>


    </form>
    </div>

    <?php
include "pie.php";
?>