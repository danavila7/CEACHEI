<?php

class HorariosController extends BaseController
{

    public function HorarioUsuarioGet($usuario_id){
        $user = Usuario::find($usuario_id);
        $horario = DB::table('horarios')
                    ->where('id_usuario', $usuario_id)
                    ->get();
        if(is_null($user))
        {
            return Redirect::to('ListaUsuarios/alumnos');
        }
        return View::make('horarios.horariousuario')->with('user', $user)->with('horario', $horario);
    }

    public function GetHorarioById($horario_id){
        $horario = Horario::find($horario_id);
        $fecha_desde = $horario->dia_start.'-'.$horario->mes_start.'-'. $horario->ano_start.' '.$horario->hora_start.':'.$horario->minuto_start;
        $fecha_hasta = $horario->dia_end.'-'.$horario->mes_end.'-'. $horario->ano_end.' '.$horario->hora_end.':'.$horario->minuto_end;
        $instructor = Usuario::find($horario->id_instructor);
        $alumno = Usuario::find($horario->id_usuario);
        $data = array(
            'titulo' => $horario->titulo,
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta,
            'instructor' => $instructor->fullname,
            'alumno' => $alumno->fullname
            );
        return Response::json($data);
    }

    public function MisHorarios(){
        $horario = Horario::with('instructor')
                    ->where('id_usuario', Auth::user()->id)
                    ->get();
        $user = Auth::user();
        if(is_null($user))
        {
            return Redirect::to('ListaUsuarios/alumnos');
        }
        return View::make('horarios.horariousuario')->with('user', $user)->with('horario', $horario);
    }

    public function AllHorario(){
        $horas = array(
            '08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30',
            '14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00',
            '19:30','20:00','20:30','21:00'
            );
        $horario = Horario::with('alumno', 'instructor')->get();
        $instructores = Usuario::join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                        ->where('usuarios.activo', 1)
                        ->where('assigned_roles.role_id', 9)->get();
        return View::make('horarios.allhorarios', compact('horario', 'instructores','horas'));
    }

    public function GuardarHorario(){
        $fecha = explode("/", Input::get("fecha"));
        $dia = $fecha[0];
        $mes = $fecha[1]-1;
        $ano = $fecha[2];

        $hora_desde = explode(":", Input::get("hora_desde"));
        $hora_d = $hora_desde[0];
        $minuto_d = $hora_desde[1];

        $hora_hasta = explode(":", Input::get("hora_hasta"));
        $hora_h = $hora_hasta[0];
        $minuto_h = $hora_hasta[1];

        $horario = new Horario;
        $horario->ano_start =  $ano;
        $horario->mes_start =  $mes;
        $horario->dia_start =  $dia;
        $horario->hora_start =  $hora_d;
        $horario->minuto_start =  $minuto_d;
        $horario->ano_end =  $ano;
        $horario->mes_end =  $mes;
        $horario->dia_end =  $dia;
        $horario->hora_end =  $hora_h;
        $horario->minuto_end =  $minuto_h;
        $horario->titulo =  Input::get('clase');
        $horario->todo_dia =  false;
        $horario->id_usuario =  Input::get('id_usuario');
        $horario->id_instructor =  Input::get('id_instructor');
        $horario->save();
    }

    public function BorrarHorarioGet(){
        $id = Input::get('id');
        $horario = Horario::find($id);
        $horario->delete();
    }


}