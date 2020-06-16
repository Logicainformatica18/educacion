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



    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v4.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="538812943216349" theme_color="#6699cc" logged_in_greeting="Hola, en qué te puedo ayudar?" logged_out_greeting="Hola, en qué te puedo ayudar?">
    </div>
    <!--  ------------------------ -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v4.0">
    </script>

    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="index.php" class="brand-logo">
                <img src="imagenes/cesca.png" width="130px">
            </a>
            <ul class="right hide-on-med-and-down">

                <li class="scroll"><a href="sylabus.php">Sylabus </a></li>
                <li class="scroll"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li class="scroll active"><a href="index.php">Inicio </a></li>
                <li class="scroll"><a href="sylabus.php">Sylabus </a></li>
                <li class="scroll"><a href="alumno_login.php">Alumno </a></li>
                <li class="scroll"><a href="profesor_login.php">Profesor</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>

    <div id="index-banner" class="parallax-container">

        <div class="section no-pad-bot">
            <div class="container">

                <br><br>
                <h1 class="header center white-text text-darken-2"><b></b></h1>
                <div class="row center">
                    <h5 class="header col s12 light"></h5>
                </div>
                <div class="row center">
                    <a href="https://www.facebook.com/Anthonyrc16" class="btn waves-effect red" target="_blank"><b>Agrégame en <span class='black-text'>facebook.com/Anthonyrc16</span></b></a>
                    <a href="#" id="download-button" class="btn waves-effect green"><b>997852483</b></a>
                    <a href="#" id="download-button" class="btn waves-effect blue"><b>Logicainformatica18@gmail.com</b></a>
                </div>
                <br><br>

            </div>
        </div>
        <div class="parallax"><img src="https://scontent.flim18-3.fna.fbcdn.net/v/t1.0-9/94867177_3170247742985584_4111340637888970752_o.jpg?_nc_cat=110&_nc_sid=dd9801&_nc_eui2=AeGSoQEVafrV61QhkhkOEpuSljlDdV_2A1GWOUN1X_YDUccxM_USUkimwilQ1lf67N1s2XDT0Gn_6pTn7pdfRKO_&_nc_ohc=O77w2blE8I0AX9IA415&_nc_ht=scontent.flim18-3.fna&oh=d311821c39958e59c564a74100a2d643&oe=5EE2FEC9">
        </div>
    </div>
    <?php
    include "conexion.php";
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $semana = isset($_POST['semana']) ? $_POST['semana'] : "";
    $curso = isset($_GET['curso']) ? $_GET['curso'] : "";
    $selected = "";
    $j3 = 0;
    ?>


    <div class="container">

    </div>





    <?php
    include "pie.php";
    ?>