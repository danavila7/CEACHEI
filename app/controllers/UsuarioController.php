<?php

class UsuarioController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';

    /**
     * Show the profile for the given user.
     */

    public function getLogin(){
        if (Auth::check()){
            return Redirect::to('admin/home');
        }else{
            return View::make('login')->with('success', true);;
        }
    }

    public function postLogin(){
        $credentials = array(
        'email' => Input::get('email'),
        'password' => Input::get('password'));
        if(Auth::attempt($credentials)){
            $user = Usuario::where('email', '=', Input::get('email'))->firstOrFail();
            Auth::login($user);
            return Redirect::to('admin/home');
        }else{
            return View::make('login')->with('success', false);
        }
    }


    public function Home(){

            $usuarios_activos = Usuario::where('activo', true)
                            ->join('assigned_roles', 'usuarios.id', '=', 'assigned_roles.user_id')
                            ->where('assigned_roles.role_id', 10)
                            ->count();
            $usuarios_all = Usuario::join('assigned_roles', 'usuarios.id', '=', 'assigned_roles.user_id')
                            ->where('assigned_roles.role_id', 10)
                            ->count();

            $instructores_activos = Usuario::where('activo', true)
                            ->join('assigned_roles', 'usuarios.id', '=', 'assigned_roles.user_id')
                            ->where('assigned_roles.role_id', 9)
                            ->count();
            $recepcion_activos = Usuario::where('activo', true)
                            ->join('assigned_roles', 'usuarios.id', '=', 'assigned_roles.user_id')
                            ->where('assigned_roles.role_id', 8)
                            ->orWhere('assigned_roles.role_id', 7)
                            ->count();
            //Opex
            $t_opex = Opex::sum('monto');
            $total_eduardo_o = Opex::where('id_usuario', 5)->sum('monto');
            $total_ceachei_o = Opex::where('id_usuario', 4)->sum('monto');


            //Capex
            $t_capex = Capex::sum('monto');
            $total_eduardo_c = Capex::where('id_usuario', 5)->sum('monto');
            $total_ceachei_c = Capex::where('id_usuario', 4)->sum('monto');

            $total_eduardo = $total_eduardo_o + $total_eduardo_c;
            $total_ceachei = $total_ceachei_o + $total_ceachei_c;

            $total_final = $t_capex + $t_opex;

            return View::make('home' , compact('t_opex', 'total_eduardo_o', 'total_ceachei_o',
                                    't_capex', 'total_eduardo_c', 'total_ceachei_c', 'total_eduardo',
                                    'total_ceachei', 'total_final', 'usuarios_activos', 'usuarios_all',
                                    'instructores_activos', 'recepcion_activos'));
    }

    public function CrearRoles(){

        $admin = new Role();
        $admin->name         = 'administracion';
        $admin->save();

        $secretaria = new Role();
        $secretaria->name         = 'recepcion';
        $secretaria->save();

        $instructiores = new Role();
        $instructiores->name         = 'instructores';
        $instructiores->save();

        $alumno = new Role();
        $alumno->name         = 'alumno';
        $alumno->save();
    }



    public function LoginUsuarioGet(){
        $credentials = array(
        'email' => Input::get('email'),
        'password' => Input::get('password'));
        if(Auth::attempt($credentials)){
            $user = Usuario::where('email', '=', Input::get('email'))->firstOrFail();
            Auth::login($user);
            return View::make('home');
        }else{
            return Response::json(array('msg'=>'0'));
        }
    }

     public function CerrarSesionGet(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function ListaUsuarios($filtro = null){


        $user = Usuario::with('plan', 'assigned');
        $es_id = null;
        if(Entrust::hasRole('recepcion')){
            $user = Usuario::with('plan', 'assigned')
                            ->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                            ->join('roles', 'roles.id','=','assigned_roles.role_id')
                            ->orWhere('roles.name','alumno')
                            ->orWhere('roles.name','instructores');
        }

        if($filtro == 'usuarios'){
            $es_id = 1;
                    //$userrole = DB::table('assigned_roles')->lists('user_id');
                    $user = Usuario::select('usuarios.*')
                                    //->select('usuarios.nombre as nombre, usuarios.id as user_id')
                                    ->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id', 'left outer')
                                    ->where('assigned_roles.user_id',null);
        }
        if($filtro == 'alumno'){
            $es_id = 2;
            $user = Usuario::with('plan', 'assigned')->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                            ->join('roles', 'roles.id','=','assigned_roles.role_id')
                            ->where('roles.name','alumno');
        }
        if($filtro == 'instructores'){
            $es_id = 3;
            $user = Usuario::with('plan', 'assigned')->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                            ->join('roles', 'roles.id','=','assigned_roles.role_id')
                            ->where('roles.name','instructores');
        }
        if($filtro == 'administracion'){
            $es_id = 3;
            $user = Usuario::with('plan', 'assigned')->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                            ->join('roles', 'roles.id','=','assigned_roles.role_id')
                            ->where('roles.name','administracion')->orWhere('roles.name','recepcion');
        }


        $filter = DataFilter::source($user);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->add('created_at','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('search');
        $filter->reset('reset');

        $grid = DataSet::source($filter);  //same source types of DataSet
        $grid->orderBy('apellido_paterno','desc'); //default orderby
        $grid->paginate(10); //pagination
        $grid->build();

        return View::make('usuarios.listausuarios', compact('filter', 'grid', 'es_id', 'filtro'));
    }

    public function CrudUsuarios(){

        $permiso = array(
            '0'=>'Seleccione un permiso',
            'Administrador'=>'Administrador',
            'Alumno'=>'Alumno',
            'Profesor'=>'Profesor'
            );
        $activo = array(1 => 'Si', 0 => 'No');

        $edit = DataEdit::source(new Usuario());
        $edit->label('Usuarios');
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('apellido_paterno','Apellido Paterno', 'text')->rule('required');
        $edit->add('apellido_materno','Apellido Materno', 'text')->rule('required');
        $edit->add('fecha_nacimiento','Fecha Nacimiento','date')->format('d/m/Y', 'it');
        $edit->add('rut','Rut', 'text')->rule('required');
        $edit->add('telefono','Telefono', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');
        $edit->add('id_plan','Plan','select')->options(Planes::lists("nombre", "id"));
        $edit->add('imagen','Foto', 'image')->move('uploads/usuarios/')->fit(240, 160)->preview(120,80);
        $edit->add('activo','Activo','select')->options($activo);
        $edit->add('password','Passwrod', 'password')->rule('required');

        return $edit->view('usuarios.crudusuarios', compact('edit'));
    }

    public function AsignarRolGet($id = null){
        if($id){
            $usuario = Usuario::find($id);
        if(isset($usuario)){
            $user_role = DB::table('assigned_roles')
                    ->where('user_id', $id)
                    ->lists('role_id');
            $roles = DB::table('roles')->get();
            if(Entrust::hasRole('recepcion')){
                $roles = DB::table('roles')->where('name','instructores')
                                            ->orWhere('name','alumno')->get();
            }
            return View::make('usuarios.asignarol')->with('usuario', $usuario)
                                            ->with('roles', $roles)
                                            ->with('user_role', $user_role);
        }else{
            return Redirect::to('/');
        }
        }else{
            return Redirect::to('/');
        }
    }

    /**
     * Asigna Rol Post
     *
     * @return Response
     */
    public function AsignarRolPost(){
        $id = Input::get('user_id');
        $role_user = Input::get('role_user');
        $user = Usuario::find($id);

        $rol_user = DB::table('assigned_roles')
                    ->where('user_id', $id)
                    ->delete();

        if($role_user){
            foreach ($role_user as $ru) {
                DB::table('assigned_roles')->insert(
                    array('user_id' => $id, 'role_id' => $ru)
                );
            }
        }


        return Redirect::to('/');
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



    public function getUsuarioList(){
        return Usuario::where("nombre","like", Input::get("q")."%")
                ->orWhere("email","like", Input::get("q")."%")
                ->orWhere("apellido_paterno","like", Input::get("q")."%")
                ->orWhere("apellido_materno","like", Input::get("q")."%")->take(10)->get();
    }
}