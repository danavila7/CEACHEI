$(document).ready(function() {
     $('.borrar_opex').click(function(){
    	var r = confirm("¿Desea borrar este Opex?");
		if (r == true) {
			var id = $(this).attr('data-id');
			$.ajax({
			type: "GET",
			url: $('#baseurl').val()+"/BorrarOpex/"+id,
			success:function(data){
				jsondata = eval(data);
				msg = eval(jsondata.msg);
				if(msg == '1'){
					alert('Opex borrado con exito!');
					location.reload();
				}else{
					alert('Este Opex no se pudo borrar.');
				}				
			},
			error:function (response){
				error = eval(response);
				alert('error'+error)
			}
			});
		}
    });
});