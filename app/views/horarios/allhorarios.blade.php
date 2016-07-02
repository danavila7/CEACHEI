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
<link rel="stylesheet" href="{{ asset("lib/admin-lte/plugins/fullcalendar/fullCalendar.min.css")}}" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset("lib/admin-lte/plugins/fullcalendar/fullCalendar.min.js")}}"></script>

 <script type="text/javascript">

 $(function () {
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
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
        @foreach ($horario as $hor)
            {
            title: '{{ $hor->titulo }}',
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
            allDay: false
            },
        @endforeach
      ],
      defaultView:'agendaWeek',
      editable: true,
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
      dayClick: function() {
        console.log('crea calendario');
        alert('a day has been clicked!');
      }
    });
});
</script>
<div class="row">
<div class="col-md-12">
    <div class="box box-solid">
            <div class="box-body">
            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <div class="external-event bg-green" style="float: left;">Instructor1</div>
                <div class="external-event bg-yellow" style="float: left;">Instructor2</div>
                <div class="external-event bg-aqua"  style="float: left;">Instructor3</div>
                <div class="external-event bg-light-blue"  style="float: left;">Instructor4</div>
            </div>
            </div>
    </div>
</div>
</div>
<div class="row">
        <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Clases</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Instructor</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alumno</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese el nombre del alumno">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese la fecha">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Hora Desde</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="ingrese la hora">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Hora Hasta</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="ingrese la hora">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-default">Limpiar</button>
                <button type="button" class="btn btn-info pull-right">Agregar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
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

    <!--FullCalendar container div
<ul class="list-group">
    @foreach ($horario as $hor)
    <li class="list-group-item">{{ $hor->titulo }} -
        Comienzo: {{ $hor->dia_start }}/{{ $hor->mes_start + 1 }}/{{ $hor->ano_start }}
        {{ $hor->hora_start }}:{{ $hor->minuto_start }} -
        Fin: {{ $hor->dia_end }}/{{ $hor->mes_end + 1 }}/{{ $hor->ano_end }}
        {{ $hor->hora_end }}:{{ $hor->minuto_end }}
    <a class="btn btn-default borrar_horario" alt="Eliminar" data-id="{{ $hor->id }}"><i class="fa fa-close"></i></a>
    </li>
    @endforeach
</ul>-->

@stop