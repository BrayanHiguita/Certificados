const mes =new Array();
mes[0]="Enero";
mes[1]="Febrero";
mes[2]="Marzo";
mes[3]="Abril";
mes[4]="Mayo";
mes[5]="Junio";
mes[6]="Julio";
mes[7]="Agosto";
mes[8]="Septiembre";
mes[9]="Octubre";
mes[10]="Noviembre";
mes[11]="Diciembre";
hoy=new Date();
let m=mes[hoy.getMonth()];
const canvas=document.getElementById("canvas");
const ctx= canvas.getContext("2d");
/* Inicializamos la imagen */
const image= new Image();
/* Ruta de la Imagen */
image.src="../../public/Certificado.png";

$(document).ready(function(){
    var curdet_id = getUrlParameter('curdet_id');
    $.post("../../controlador/usuario.php?op=mostrar_curso_detalle",{curdet_id:curdet_id},function(data){
        data=JSON.parse(data); 
        $('#cur_descrip').html(data.cur_descrip);
        /* Dimensionamos y seleccionamos imagen */
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        /* Definimos tamaño de la fuente */
        ctx.font = 'italic 40px Times New Roman';
        ctx.textAlign = "center";
        ctx.textBaseline = 'middle';
        var x = canvas.width / 2;
        ctx.fillText(data.usu_nom+' '+data.usu_apellip+' '+data.usu_apellim, x, 210);
        ctx.fillText(data.cur_nom, x, 315);
/*         ctx.font = '20px Times New Roman';
        ctx.fillText(("Este certificado se expide el "+hoy.getDate()+" de "+m+" del "+hoy.getFullYear()), x, 343); */
        console.log(curdet_id);
    });

});
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
