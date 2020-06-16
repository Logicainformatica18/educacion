<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

   if (isset($_SESSION['loggedin_profesor']) && $_SESSION['loggedin_profesor'] == true)
    {} else {
        echo "<script>  alert('Logueese primero');
        location.href ='profesor_login.php';
      </script> ";
    
        exit;
    }
    ?>     