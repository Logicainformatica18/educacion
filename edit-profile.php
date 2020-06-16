<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    { 
     
    } else {
        echo "<script>  alert('Logueese primero');
        window.location.href='/alumno_login.php';
      </script> ";
   
        exit;
    }
    // <h4>Necesitas iniciar sesión para acceder a esta página.</h4>
      //  <p><a href='login.html'>¡Entre aquí!</a></p>
        //Comprobando el momento en que comienza la página de inicio
        $now = time();            
       ///////////////////////////////////////// DARLE UN TIEMPO DE ACCESO
       // if ($now > $_SESSION['expire'] )
       // {
       //    session_destroy();
       //     echo "<h4>¡Tu sesión ha expirado!</h4>
       //     <p><a href='../index.php'>¡Entre aquí!</a></p>";
       //     exit;
       // }
    ?>