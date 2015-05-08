<?php

class UsuarioController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';
    
    /**
     * Show the profile for the given user.
     */

    public function IndexCMA(){
        if (Auth::check()){
            return View::make('indexcma');
        }else{
            return View::make('home'); 
        }
    }

    public function LoginUsuarioGet(){
        $credentials = array(
        'email' => Input::get('email'),
        'password' => Input::get('password'));
        if(Auth::attempt($credentials)){
            $user = Usuario::where('email', '=', Input::get('email'))->firstOrFail();
            Auth::login($user);
            return Response::json(array('msg'=>Auth::check(),'tipo'=>$user->id_permiso));
        }else{
            return Response::json(array('msg'=>'0'));
        }   
    }

     public function CerrarSesionGet(){
        Auth::logout();
        return View::make('home'); 
    }

    public function ListaUsuarios(){

        $filter = DataFilter::source(Usuario::with('plan'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->orderBy('apellido_paterno','desc'); //default orderby
        $grid->paginate(10); //pagination
        $grid->build();

        return View::make('usuarios.listausuarios', compact('filter', 'grid'));
    }

    public function CrudUsuarios(){

        $permiso = array(
            '0'=>'Seleccione un permiso',
            'Administrador'=>'Administrador',
            'Alumno'=>'Alumno',
            'Profesor'=>'Profesor'
            );

        $edit = DataEdit::source(new Usuario());
        $edit->label('Usuarios');
        $edit->link("ListaUsuarios","Lista Usuarios", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('apellido_paterno','Apellido Paterno', 'text')->rule('required');
        $edit->add('apellido_materno','Apellido Materno', 'text')->rule('required');
        $edit->add('fecha_nacimiento','Fecha Nacimiento','date')->format('d/m/Y', 'it');
        $edit->add('rut','Rut', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');
        $edit->add('permiso','Permiso','select')->options($permiso);
        $edit->add('id_plan','Plan','select')->options(Planes::lists("nombre", "id"));
        $edit->add('imagen','Foto', 'image')->move('uploads/usuarios/')->fit(240, 160)->preview(120,80);
        $edit->add('activo','Activo','checkbox');

        return View::make('usuarios.crudusuarios', compact('edit'));
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
        $filter = DataFilter::source(new Planes);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->add('valor','Valor', true);
        $grid->edit(url().'/plan/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/plan/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('usuarios.listaplanes', compact('filter', 'grid'));
    }

    public function CrudPlan(){
        $edit = DataEdit::source(new Planes());
        $edit->label('Planes');
        $edit->link("ListaPlanes","Lista Planes", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('valor','Valor', 'text')->rule('required');

        return View::make('usuarios.crudplan', compact('edit'));
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