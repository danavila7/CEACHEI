<?php

class AdministracionController extends BaseController
{
    protected $layout = 'layouts.layout';

    public function ListarAdministracion(){

        $user = Usuario::join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                        ->where('assigned_roles.role_id',8)
                        ->orWhere('assigned_roles.role_id', 7);

        $filter = DataFilter::source($user);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('user_id','Buscar por ID', 'text');
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->add('email','Buscar por Email', 'text');
        $filter->add('created_at','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('search');
        $filter->reset('reset');

        $grid = DataSet::source($filter);
        $grid->orderBy('apellido_paterno','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('administracion.lista', compact('filter', 'grid'));
    }

    public function GetCrearAdministracion(){
        $planes = Planes::all();
        $roles = array(7 => 'Administrador', 8 => 'Recepción');
        return View::make('administracion.crear', compact('planes'));
    }

    public function PostCrearAdministracion(){
        $alumno = new Usuario;
        $alumno->nombre = Input::get("nombre");
        $alumno->apellido_paterno = Input::get("apellido_paterno");
        $alumno->apellido_materno = Input::get("apellido_materno");
        $fecha_nacimiento = new DateTime(Input::get("fecha_nacimiento"));
        $alumno->fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        $alumno->rut = Input::get("rut");
        $alumno->telefono = Input::get("telefono");
        $alumno->direccion = Input::get("direccion");
        $alumno->email = Input::get("email");
        $alumno->setPasswordAttribute(Input::get("rut"));
        $alumno->save();

        $assigned_roles = new Assigned;
        $assigned_roles->user_id = $alumno->id;
        $assigned_roles->role_id = Input::get("rol");
        $assigned_roles->save();

        return Redirect::to('admin/administracion/lista');
    }

    public function CrudAdministracion(){
        $activo = array(1 => 'Si', 0 => 'No');
        $edit = DataEdit::source(new Usuario());
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('apellido_paterno','Apellido Paterno', 'text')->rule('required');
        $edit->add('apellido_materno','Apellido Materno', 'text')->rule('required');
        $edit->add('fecha_nacimiento','Fecha Nacimiento','date')->format('d/m/Y', 'es');
        $edit->add('rut','Rut', 'text')->rule('required');
        $edit->add('telefono','Telefono', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');

        return $edit->view('administracion.crud', compact('edit'));
    }

}