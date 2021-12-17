var usu_id=$('#usu_idx').val();
$(document).ready(function(){
    $.post("../../controlador/usuario.php?op=mostrar",{usu_id:usu_id},function(data){
        data= JSON.parse(data); 
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apellip').val(data.usu_apellip);
        $('#usu_apellim').val(data.usu_apellim);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telefono').val(data.usu_telefono);
        $('#usu_contra').val(data.usu_contra);
        $('#usu_sex').val(data.usu_sex).trigger("change");
    });
}); 
$(document).on("click","#btnactualizar",function(){
    $.post("../../controlador/usuario.php?op=update_perfil",{
        usu_id:usu_id,
        usu_nom:$('#usu_nom').val(),
        usu_apellip:$('#usu_apellip').val(),
        usu_apellim:$('#usu_apellim').val(),
        usu_correo:$('#usu_correo').val(),
        usu_telefono:$('#usu_telefono').val(),
        usu_contra:$('#usu_contra').val(),
        usu_sex: $('#usu_sex').val()},function(data){
    });
    Swal.fire({
        title: 'Correcto!',
        text: 'Se Actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});