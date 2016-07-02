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

    public function MisHorarios(){
        $horario = DB::table('horarios')
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
        $horario = DB::table('horarios')->get();
        return View::make('horarios.allhorarios')->with('horario', $horario);
    }

    public function GuardaHorarioUsuarioGet(){

        if(Request::ajax()){
        $horario = new Horario;
        $horario->ano_start =  Input::get('ano_start');
        $horario->mes_start =  Input::get('mes_start');
        $horario->dia_start =  Input::get('dia_start');
        $horario->hora_start =  Input::get('hora_start');
        $horario->minuto_start =  Input::get('minuto_start');
        $horario->ano_end =  Input::get('ano_end');
        $horario->mes_end =  Input::get('mes_end');
        $horario->dia_end =  Input::get('dia_end');
        $horario->hora_end =  Input::get('hora_end');
        $horario->minuto_end =  Input::get('minuto_end');
        $horario->titulo =  Input::get('title');
        $horario->todo_dia =  Input::get('todo_dia');
        $horario->id_usuario =  Input::get('id_usuario');
        $horario->save();

        }
    }

    public function BorrarHorarioGet(){
        $id = Input::get('id');
        $horario = Horario::find($id);
        $horario->delete();
    }


}