@extends('layouts.layout')
@section('head')
{{ HTML::script('js/functions/horariousuario.js') }}
@stop
@section('title')
Horarios General
@stop
@section('sidebar')
    @parent
@stop
@section('content')
 <link href="{{ asset("lib/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset("lib/admin-lte/plugins/fullcalendar/fullcalendar.min.css")}}" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset("lib/admin-lte/plugins/fullcalendar/fullcalendar.min.js")}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset("packages/zofe/rapyd/assets/datepicker/datepicker3.css") }}">
<script type="{{ asset("packages/zofe/rapyd/assets/datepicker/locales/bootstrap-datepicker.es.js") }}"></script>
<script src="{{ asset("packages/zofe/rapyd/assets/datepicker/bootstrap-datepicker.js") }}"></script>
<script src="{{ asset("lib/timepicker/bootstrap-timepicker.min.js") }}"></script>
<link href="{{ asset("lib/timepicker/bootstrap-timepicker.min.css") }}" rel="stylesheet" type="text/css" />
<link media="all" type="text/css" rel="stylesheet" href="{{ asset("packages/zofe/rapyd/assets/autocomplete/autocomplete.css") }}">
<script src="{{ asset("packages/zofe/rapyd/assets/autocomplete/typeahead.bundle.min.js") }}"></script>
<script src="{{ asset("packages/zofe/rapyd/assets/template/handlebars.js") }}"></script>
<script type="text/javascript">

 $(function () {

    //autocomplete
    var blod_usuario_fullname = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('auto_usuario_fullname'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: '{{ URL::to('/') }}/admin/searchuser?q=%QUERY'
    });
    blod_usuario_fullname.initialize();

    $('#th_usuario_fullname .typeahead').typeahead(null, {
        name: 'usuario_fullname',
        displayKey: 'fullname',
        highlight: true,
        minLength: 2,
        source: blod_usuario_fullname.ttAdapter(),
        templates: {
            //
        }
    }).on("typeahead:selected typeahead:autocompleted",
        function (e,data) { $('#usuario_fullname').val(data.id);

    }).on("typeahead:closed",
        function (e,data) {
            if ($(this).val() == '') {
                $('#usuario_fullname').val('');
            }
    });
    //end autocomplete

    //elimina horario

    $('#elimina-horario').click(function(){

      var id = $(this).data('horarioid');
       var r = confirm("¿Desea Eliminar este horario?");
          if (r == true) {
              $.ajax({
                type: "GET",
                url: "{{ URL::to('/') }}/admin/borrar-horario",
                data: { id : id },
                success:function(data){
                  alert('Curso Borrado con exito!');
                  location.reload();
                },
                error:function (response){
                  error = eval(response);
                  alert('error'+error)
                }
              });
          }

    });

    //agregar horario

    $('#agregar_horario').click(function(){

      var id_instructor = $('#id_instructor').val();
      var clase = $('#clase').val();
      var id_usuario = $('#usuario_fullname').val();
      var fecha = $('#fecha').val();
      var hora_desde = $('#hora_desde').val();
      var minuto_desde = $('#minuto_desde').val();
      var hora_hasta = $('#hora_hasta').val();
      var minuto_hasta = $('#minuto_hasta').val();

      data = {
        id_instructor: id_instructor,
        clase: clase,
        id_usuario : id_usuario,
        fecha: fecha,
        hora_desde: hora_desde,
        hora_hasta: hora_hasta
      };
      //console.log(data);
      var url = "{{ URL::to('/') }}/admin/guardar-horario";
        $.post(url,data)
          .done(function( data ) {
            console.log(data);
            alert("El Horario ha sido guardado con exito!");
            location.reload();
          });
    });

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#horario').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día'
      },
      //Random default events
      events: [
        @foreach ($horario as $hor)
            {
            title: '{{ $hor->titulo }} - {{ $hor->alumno->nombre }}',
            start: new Date(
                {{ $hor->ano_start }},
                {{ $hor->mes_start }},
                {{ $hor->dia_start }},
                {{ $hor->hora_start }},
                {{ $hor->minuto_start }}),
            end: new Date(
                {{ $hor->ano_end }},
                {{ $hor->mes_end }},
                {{ $hor->dia_end }},
                {{ $hor->hora_end }},
                {{ $hor->minuto_end }}),
            allDay: false,
            backgroundColor: "{{ $hor->instructor->color }}",
            borderColor: "{{ $hor->instructor->color }}",
            id_horario: {{ $hor->id }},
            },
        @endforeach
      ],
      defaultView:'agendaWeek',
      minTime: "08:30:00",
      maxTime: "21:30:00",
      editable: false,
      allDaySlot: false,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#horario').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      },
      eventClick: function(calEvent, jsEvent, view) {

          $('#modal-horario').modal()
          var id = calEvent.id_horario;
          $.ajax({
                type: "GET",
                url: "{{ URL::to('/') }}/admin/horarios/horario-info/"+id,
                data: { id : id },
                success:function(data){
                  $('#horario-clase').text(data.titulo);
                  $('#horario-nombre-alumno').text(data.alumno);
                  $('#horario-nombre-instructor').text(data.instructor);
                  $('#horario-fecha-desde').text(data.fecha_desde);
                  $('#horario-fecha-hasta').text(data.fecha_hasta);
                  $('#elimina-horario').attr('data-horarioid', id);
                },
                error:function (response){
                  error = eval(response);
                  alert('error'+error)
                }
              });
      }
    });
});
</script>
<div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Intructores</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div>
              @foreach ($instructores as $instructor)
                <div class="external-event" style="background-color:{{ $instructor->color }}">
                {{ $instructor->nombre }} {{ $instructor->apellido_paterno }}
                </div>
              @endforeach
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Clases</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="clase">Clase</label>
                  <input type="text" class="form-control" id="clase" placeholder="Ingrese la Clase">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Instructor</label>
                  <select id="id_instructor" name="id_instructor" class="form-control" data-live-search="true" title="Seleccione un intructor">
                    @foreach ($instructores as $ins)
                    <option value="{{ $ins->user_id }}">
                        {{ $ins->nombre }} {{ $ins->apellido_paterno }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="alumno">Alumno</label>
                  <span id="th_usuario_fullname">
                  <input placeholder="Nombre Alumno" class="form-control autocompleter typeahead" type="text" id="auto_usuario_fullname" name="auto_usuario_fullname">
                  <input id="usuario_fullname" name="usuario_fullname" type="hidden"></span>
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input type="text" class="form-control datepicker_local" id="fecha" placeholder="Ingrese la fecha">
                </div>
                <div class="form-group">
                  <label for="horadesde">Hora Desde</label>
                  <select id="hora_desde" name="hora_desde" class="form-control" title="Hora Desde">
                    @foreach ($horas as $hora)
                    <option value="{{ $hora }}">
                        {{ $hora }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="horadesde">Hora Hasta</label>
                  <select id="hora_hasta" name="hora_hasta" class="form-control" title="Hora Hasta">
                    @foreach ($horas as $hora)
                    <option value="{{ $hora }}">
                        {{ $hora }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!--<button type="button" class="btn btn-default">Limpiar</button>-->
                <button type="button" class="btn btn-info pull-right" id="agregar_horario">Agregar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="horario"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="modal fade" id="modal-horario" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Horario</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title" id="horario-nombre-alumno"></h3>
          </div>
          <div class="panel-body">
            <p>Clase: <span id="horario-clase"></span></p>
            <p>Instructor: <span id="horario-nombre-instructor"></span></p>
            <p>Fecha Desde: <span id="horario-fecha-desde"></span></p>
            <p>Fecha Hasta: <span id="horario-fecha-hasta"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="elimina-horario" data-horarioid="">Eliminar Horario</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--<ul class="list-group">
    @foreach ($horario as $hor)
    <li class="list-group-item">{{ print_r($hor->instructor->fullname) }} -
        Comienzo: {{ $hor->dia_start }}/{{ $hor->mes_start + 1 }}/{{ $hor->ano_start }}
        {{ $hor->hora_start }}:{{ $hor->minuto_start }} -
        Fin: {{ $hor->dia_end }}/{{ $hor->mes_end + 1 }}/{{ $hor->ano_end }}
        {{ $hor->hora_end }}:{{ $hor->minuto_end }}
    <a class="btn btn-default borrar_horario" alt="Eliminar" data-id="{{ $hor->id }}"><i class="fa fa-close"></i></a>
    </li>
    @endforeach
</ul>-->

@stop