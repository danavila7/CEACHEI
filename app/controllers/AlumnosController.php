<?php

class AlumnosController extends BaseController
{

    public function ListarAlumnos($activo = 0){

        if($activo == 1){
        $user = Usuario::join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                        ->where('usuarios.activo', $activo)
                        ->where('assigned_roles.role_id',10);
        }else{
        $user = Usuario::join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                        ->where('assigned_roles.role_id',10);
        }


        $filter = DataFilter::source($user);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('user_id','Buscar por ID', 'text');
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->add('email','Buscar por Email', 'text');
        $filter->add('created_at','Fecha de Ingreso','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->orderBy('apellido_paterno','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('alumnos.lista', compact('filter', 'grid', 'activo'));
    }

    public function GetCrearAlumnos(){
        $planes = Planes::all();
        return View::make('alumnos.crear', compact('planes'));
    }

    public function PostCrearAlumnos(){

        $alumno = new Usuario;
        $alumno->nombre = Input::get("nombre");
        $alumno->apellido_paterno = Input::get("apellido_paterno");
        $alumno->apellido_materno = Input::get("apellido_materno");
        $fecha_nacimiento = new DateTime(date('Y-m-d', strtotime(Input::get("fecha_nacimiento"))));
        $alumno->fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        $fecha_inscripcion = new DateTime(date('Y-m-d', strtotime(Input::get("fecha_inscripcion"))));
        $alumno->fecha_inscripcion = $fecha_inscripcion->format('Y-m-d');
        $alumno->rut = Input::get("rut");
        $alumno->telefono = Input::get("telefono");
        $alumno->direccion = Input::get("direccion");
        $alumno->email = Input::get("email");
        $alumno->id_plan = Input::get("id_plan");
        $alumno->setPasswordAttribute(Input::get("rut"));
        $alumno->save();

        $assigned_roles = new Assigned;
        $assigned_roles->user_id = $alumno->id;
        $assigned_roles->role_id = 10;
        $assigned_roles->save();

        return Redirect::to('admin/alumnos/lista');
    }


    public function CrudAlumnos(){
        $activo = array(1 => 'Si', 0 => 'No');
        $edit = DataEdit::source(new Usuario());

        $edit->add('fecha_inscripcion','Fecha Inscripción','date')->format('d/m/Y', 'es');
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('apellido_paterno','Apellido Paterno', 'text')->rule('required');
        $edit->add('apellido_materno','Apellido Materno', 'text')->rule('required');
        $edit->add('fecha_nacimiento','Fecha Nacimiento','date')->format('d/m/Y', 'es');
        $edit->add('rut','Rut', 'text')->rule('required');
        $edit->add('telefono','Telefono', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');
        $edit->add('id_plan','Plan','select')->options(Planes::lists("nombre", "id"));
        //$edit->add('imagen','Foto', 'image')->move('uploads/usuarios/')->fit(240, 160)->preview(120,80);
        $edit->add('activo','Activo','select')->options($activo);
        //$edit->add('password','Passwrod', 'password')->rule('required');

        return $edit->view('alumnos.crud', compact('edit'));
    }
}