function eliminar(id){
    if (confirm('¿Estas seguro de eliminar este Alumno?'))
{
       window.location.href ="registro_mantenimiento.php?del=" + id;
    }
}
function llenar_notas(idd){
   

       window.location.href ="registro_mantenimiento.php?registro_detalle=" + idd;
    
}
function reporte_asistencia_actual(registro){
   

   window.location.href ="registro_mantenimiento.php?registro=" + registro;

}
function registro_delete(id){
    if (confirm('¿Estas seguro de eliminar?'))
{
       window.location.href ="programacion_profesor.php?r=" + id;
    }
}

