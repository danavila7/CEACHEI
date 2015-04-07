<?php

class OpexController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';
    
   public function ListaCatOpexGet(){
        $cat_opex = CatOpex::all();
        return View::make('opex.listacatopex', array('catopex'=>$cat_opex));
    }

    public function CrearCatOpexGet(){
        return View::make('opex.crearcatopex');
    }

    public function CrearCatOpexPost(){
        $catopex = new CatOpex;
        $catopex->nombre = Input::get("nombre");
        $catopex->save();
        $LastInsertId = $catopex->id;

        return Redirect::to('ListaCatOpex');
    }

     public function EditarCatOpexGet($id){
        $catopex = CatOpex::find($id);
        if(is_null($catopex))
        {
            return Redirect::to('ListaCatOpex');
        }
        return View::make('opex.editarcatopex')->with('catopex', $catopex);
    }

    public function EditarCatOpexPost(){
        $catopex = CatOpex::find(Input::get("id"));
        $catopex->nombre = Input::get("nombre");
        $catopex->save();
        $LastInsertId = $catopex->id;

        return Redirect::to('ListaCatOpex');
    }

     public function BorrarCatOpexGet($id){
        $catopex = CatOpex::find($id);
        if(is_null($catopex))
        {
            return Redirect::to('ListaCatOpex');
        }

        $opex = DB::table('opex')
            ->where('id_cat_opex', '=', $id )
            ->first();

        if(!is_null($opex)){
            return Response::json(array('msg'=>'0'));
        }else{
            //borra plan si nadie lo tiene
            $catopex->delete();
            return Response::json(array('msg'=>'1'));
        }
        return Redirect::to('ListaCatOpex');
    }



    public function ListaOpex(){
        $opex = Opex::all();
        $opexs = array();
        foreach($opex as $op){
            $cat = "Sin Categoria";
            $use = "Sin Responsable";
            
            $resp = DB::table('usuarios')
                    ->where('id', $op->id_usaurio)
                    ->first();

            $cate = DB::table('cat_opex')
                    ->where('id', $op->id_cat_opex)
                    ->first();

            if($cate){
                $cat = $cate->nombre;
            }

            $opexs[] = array(
                "id" => $op->id,
                "producto" => $op->producto,
                "monto" => $op->monto,
                "num_boleta" => $op->num_boleta,
                "num_factura" => $op->num_factura,
                "observacion" => $op->observacion,
                "responsable" => $use,
                "categoria" => $cat,
                "fecha" => $op->created_at
                );
        }
        return View::make('opex.listaopex', array('opexs'=>$opexs));
    }

    public function CrearOpexGet(){
        $catopex = CatOpex::all();

        $usuarios = DB::table('usuarios')
                    ->where('id_permiso', '1')
                    ->get();

        return View::make('opex.crearopex')->with('catopex', $catopex)
        									->with('usuarios', $usuarios);
    }

    public function CrearOpexPost(){
        $opex = new Opex;
        $opex->producto = Input::get("producto");
        $opex->num_boleta = Input::get("num_boleta");
        $opex->num_factura = Input::get("num_factura");
        $opex->monto = Input::get("monto");
        $opex->id_usaurio = Input::get("id_usaurio");
        $opex->observacion = Input::get("observacion");
        $opex->id_cat_opex = Input::get("id_cat_opex");
        $opex->save();
        $LastInsertId = $opex->id;

        return Redirect::to('ListaOpex');
    }

    public function BorrarUsuarioGet($usuario_id){
        $user = Usuario::find($usuario_id);
        if(is_null($user))
        {
            return Redirect::to('ListaUsuarios');
        }
        $user->delete();
        return Redirect::to('ListaUsuarios');
    }

    public function EditarUsuarioGet($usuario_id){
        $user = Usuario::find($usuario_id);
        if(is_null($user))
        {
            return Redirect::to('ListaUsuarios');
        }
        return View::make('usuarios.editarusuario')->with('user', $user);
    }

    public function EditarUsuarioPost(){
        $user = Usuario::find(Input::get("id"));
        $user->nombre = Input::get("nombre");
        $user->apellido_paterno = Input::get("apellido_paterno");
        $user->apellido_materno = Input::get("apellido_materno");
        $user->password = Hash::make(Input::get("password"));
        $user->realpassword = Input::get("password");
        $user->fecha_nacimiento = Input::get("fecha_nacimiento");
        $user->rut = Input::get("rut");
        $user->direccion = Input::get("direccion");
        $user->id_permiso = Input::get("permiso");
        $user->email = Input::get("email");
        $user->save();
        $LastInsertId = $user->id;

        return Redirect::to('ListaUsuarios');
    }

    public function HorarioUsuarioGet($usuario_id){
        $user = Usuario::find($usuario_id);
        $horario = DB::table('horarios')
                    ->where('id_usuario', $usuario_id)
                    ->get();
        if(is_null($user))
        {
            return Redirect::to('ListaUsuarios');
        }
        return View::make('usuarios.horariousuario')->with('user', $user)->with('horario', $horario);
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



    public function ListaPlanes(){
        $planes = Planes::all();
        return View::make('usuarios.listaplanes', array('planes'=>$planes));
    }

    public function CrearPlanGet(){
        return View::make('usuarios.crearplan');
    }

    public function CrearPlanPost(){
        $plan = new Planes;
        $plan->nombre = Input::get("nombre");
        $plan->valor = Input::get("valor");
        $plan->save();
        $LastInsertId = $plan->id;

        return Redirect::to('ListaPlanes');
    }

    public function BorrarPlanGet($plan_id){
        $plan = Planes::find($plan_id);
        if(is_null($plan))
        {
            return Redirect::to('ListaPlanes');
        }

        $usuario = DB::table('usuarios')
            ->where('id_plan', '=', $plan_id )
            ->first();

        if(!is_null($usuario)){
            return Response::json(array('msg'=>'0'));
        }else{
            //borra plan si nadie lo tiene
            $plan->delete();
            return Response::json(array('msg'=>'1'));
        }
        return Redirect::to('ListaPlanes');
    }

    public function EditarPlanGet($plan_id){
        $plan = Planes::find($plan_id);
        if(is_null($plan))
        {
            return Redirect::to('ListaPlanes');
        }
        return View::make('usuarios.editarplan')->with('plan', $plan);
    }

    public function EditarPlanPost(){
        $plan = Planes::find(Input::get("id"));
        $plan->nombre = Input::get("nombre");
        $plan->valor = Input::get("valor");
        $plan->save();
        $LastInsertId = $plan->id;

        return Redirect::to('ListaPlanes');
    }

     public function ListaAlumnoExamenesGet($id_user){
        $user = Usuario::find($id_user);
        $examenusuarios = DB::table('examenusuarios')
            ->where('id_usuario', '=', $id_user )
            ->lists('id_examen');

        $exam = Examen::all();
        $examenes = array();
        foreach($exam as $e){
            $existe = false;
            if(in_array($e->id, $examenusuarios)){
                $existe = true;
            }
            $examenes[] = array(
                "id"=>$e->id,
                "nombre"=>$e->nombre,
                "existe"=>$existe
            );
        }
        return View::make('examenes.listaalumnoexamenes')
                                                    ->with('user', $user)
                                                    ->with('examenes', $examenes);
    }

    public function AgregarExamenAlumnoGet($id_examen, $id_usuario){
        $examenusuario = new ExamenUsuario;
        $examenusuario->id_examen = $id_examen;
        $examenusuario->id_usuario = $id_usuario;
        $examenusuario->save();
        return Response::json(array('msg'=>'ok'));
    }

    public function QuitarExamenAlumnoGet($id_examen, $id_usuario){
        $examen_preguntas = DB::table('examenusuarios')
            ->where('id_examen', '=', $id_examen )
            ->where('id_usuario','=',$id_usuario)
            ->delete();
        return Response::json(array('msg'=>'ok'));
    }

    public function ObtieneUserLogeado(){
        if(Auth::check()){
            $user = Usuario::find(Auth::user()->id);
            $nombre = $user->usuario;
            $email = $user->email;
            $esCreado = $user->esCreado;
            $id = $user->id;
            return Response::json(array('msg'=>'true','nombre'=>$nombre,'email'=>$email, 'esCreado'=>$esCreado));
        }else{
            return Response::json(array('msg'=>'false'));
        }  
    }
    
    //cambia la imagen del perfil
    public function CargaImagenPerfil(){
        if (Input::hasFile('file')){
            $perfil = DB::table('perfiles')
                    ->where('usuario_id', Auth::user()->id)
                    ->first();
            $file = Input::file('file');
            $destinationPath = '../public/perfil';
            $extension =$file->getClientOriginalExtension(); 
            $file_name = $file->getClientOriginalName();
            $filename = $file_name.'.'.$extension;
            $perfil->avatar_path = $filename;
            $perfil->save();
            $upload_success = $file->move($destinationPath, $filename);
        }
        return Response::json(array('msg'=>'ok'));
    }
}