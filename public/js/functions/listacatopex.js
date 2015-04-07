$(document).ready(function() {
     $('.borrar_catopex').click(function(){
    	var r = confirm("¿Desea borrar esta categoría?");
		if (r == true) {
			var id = $(this).attr('data-id');
			$.ajax({
			type: "GET",
			url: $('#baseurl').val()+"/BorrarCatOpex/"+id,
			success:function(data){
				jsondata = eval(data);
				msg = eval(jsondata.msg);
				if(msg == '1'){
					alert('Categoría borrada con exito!');
					location.reload();
				}else{
					alert('Esta Categoría se encuentra ligada a un producto, no se puede borrar.');
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