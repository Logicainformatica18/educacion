function calcular_fecha()
{
    var hoy =formulario.dtfecha_inicio.value;

    var a=Date.parse(hoy);
    fecha =  new Date(a);
fecha.setDate(fecha.getDate()+77);
var anio=fecha.getFullYear();
var mes=(fecha.getMonth() + 1);
var dia=(fecha.getDate()+1 );
if(parseInt(dia)<=9)
{
    dia="0"+dia;
}
if(parseInt(mes)<=9)
{
    mes="0"+mes;
}
var ff=anio+"-"+mes+"-"+dia;
   formulario.dtfecha_fin.value=ff;
}
