$(document).ready(function() {

    $( ".datepicker" ).datepicker({
      	format: 'dd-mm-yyyy',
        language: 'es'
	});

    $("#calendar").datepicker();

    $('.link-to-user').click(function(){
            var url = $('#base_url').val();
            var id = $(this).data('id');
            window.location.replace(url+'/admin/alumnos/crud?modify='+id);

    });

    $('#cuotas-completas').click(function(){
        var url = $('#base_url').val();
        if ($(this).is(':checked')) {
            window.location.replace(url+'/admin/matriculas/lista/1');
        }else{
            window.location.replace(url+'/admin/matriculas/lista');
        }

    });
});