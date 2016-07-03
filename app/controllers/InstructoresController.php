<?php

class InstructoresController extends BaseController
{
    protected $layout = 'layouts.layout';

    public function ListarInstructores(){
        $user = Usuario::join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                        ->where('assigned_roles.role_id', 9);

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

        return View::make('instructores.lista', compact('filter', 'grid'));
    }

    public function GetCrearInstructor(){
        $planes = Planes::all();
        return View::make('instructores.crear', compact('planes'));
    }

    public function PostCrearInsctructor(){
        $instructor = new Usuario;
        $instructor->nombre = Input::get("nombre");
        $instructor->apellido_paterno = Input::get("apellido_paterno");
        $instructor->apellido_materno = Input::get("apellido_materno");
        $fecha_nacimiento = new DateTime(date('Y-m-d', strtotime(Input::get("fecha_nacimiento"))));
        $instructor->fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        $instructor->rut = Input::get("rut");
        $instructor->telefono = Input::get("telefono");
        $instructor->direccion = Input::get("direccion");
        $instructor->email = Input::get("email");
        $instructor->setPasswordAttribute(Input::get("rut"));
        $instructor->save();

        $assigned_roles = new Assigned;
        $assigned_roles->user_id = $instructor->id;
        $assigned_roles->role_id = 9;
        $assigned_roles->save();

        return Redirect::to('admin/instructores/lista');
    }

    public function CrudInstructor(){
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
        //$edit->add('imagen','Foto', 'image')->move('uploads/usuarios/')->fit(240, 160)->preview(120,80);
        //$edit->add('password','Passwrod', 'password')->rule('required');

        return $edit->view('instructores.crud', compact('edit'));
    }

}