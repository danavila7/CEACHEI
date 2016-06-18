<?php

class ClasesController extends BaseController
{
    protected $layout = 'layouts.layout';

    public function ListaClasesUsuario($id){
        $usuario = Usuario::find($id);
        $plan = Planes::find($usuario->id_plan);
        $clases = Clases::with('instructor')->where('usuario_id',$id);
        $num_clases = $clases->count();
        $filter = DataFilter::source($clases);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('fecha_clases','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('fecha_clases','Fecha', true);
        $grid->add('observacion','Observación', true);
        $grid->add('instructor.nombre','Instructor', 'instructor_id');
        if(!Entrust::hasRole('recepcion')){
        $grid->edit(url().'/admin/clases/'.$id.'/edit', 'Editar/Borrar','show|modify|delete');
        }
        $grid->link('/admin/clases/'.$id.'/edit', 'Crear Nueva Clase', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('clases.lista', compact('filter', 'grid', 'usuario', 'plan', 'num_clases'));
    }

    public function MisClases(){
        $clases = Clases::with('instructor')->where('usuario_id',Auth::user()->id);
        $plan = Planes::find(Auth::user()->id_plan);
        $filter = DataFilter::source($clases);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('fecha_clases','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('fecha_clases','Fecha', true);
        $grid->add('observacion','Observación', true);
        $grid->add('instructor.fullname','Instructor', 'instructor_id');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('clases.misclases', compact('filter', 'grid','plan'));
    }

    public function CrudClases($id){
        $edit = DataEdit::source(new Clases());
        $edit->label('Clases');
        $edit->link("admin/Clases/".$id,"Lista Clases", "TR")->back();
        $edit->add('fecha_clases','Fecha Clase', 'datetime')->format('d/m/Y H:i:s', 'es')->rule('required');
        $edit->add('observacion','Observación', 'textarea')->rule('required');
        if(Entrust::hasRole('instructores')){
            $edit->set('instructor_id', Auth::id());
        }else{
             $instructores = DB::table('usuarios')
                        ->select('nombre as instru_nombre', 'usuarios.id as instru_id')
                        ->join('assigned_roles as a', 'usuarios.id', '=', 'a.user_id')
                        ->where('a.role_id', 9)
                        ->where('activo', true)
                        ->lists("instru_nombre", "instru_id");

            $edit->add('instructor_id','Instructor','select')
                    ->options($instructores);
        }
        $edit->set('usuario_id',$id);

        return $edit->view('clases.crud', compact('edit'));
    }

    public function getInstructorList(){
        return Usuario::where("nombre","like", Input::get("q")."%")
                ->where('activo', true)
                ->join('assigned_roles', 'usuarios.id', '=', 'assigned_roles.user_id')
                ->where('assigned_roles.role_id', 9) //instructor
                ->orWhere("email","like", Input::get("q")."%")
                ->orWhere("apellido_paterno","like", Input::get("q")."%")
                ->orWhere("apellido_materno","like", Input::get("q")."%")->take(10)->get();
    }
}