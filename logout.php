<?php
/*
session_start — Iniciar una nueva sesión o reanudar la existente
Cuando session_start() es llamada o cuando se autoinicia una sesión, PHP llamará a los gestores
de almacenamiento de sesiones open y read. Éstos serán un gestor de almacenamiento proporcionado 
por omisión o por extensiones de PHP (como SQLite o Memcached); o pueden ser un gestor personalizado 
está definido en session_set_save_handler(). La llamada de retorno read recuperará 
información se de sesión existente (almacenada en un formato serializado especial) y será deserializada
y usada para rellenar automáticamente la variable superglobal $_SESSION cuando la llamada de retorno
 read devuelva la información de sesión guardada a la gestión de sesiones de PHP.
*/
session_start();
//La función session_unset() libera todas las variables de sesión actualmente registradas.

/*session_destroy() destruye toda la información asociada con la sesión actual. No destruye 
ninguna de las variables globales asociadas con la sesión, ni destruye la cookie de sesión. 
Para volver a utilizar las variables de sesión se debe llamar a session_start().
*/
session_destroy();
// header  redirecciona a una pagina
header('Location: index.php');

?>