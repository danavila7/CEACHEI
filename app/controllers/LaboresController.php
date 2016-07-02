<?php

class LaboresController extends BaseController
{
    public function ListaLabores(){
        $filter = DataFilter::source(Labores::with('usuario'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('usuario.nombre','Responsable','text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('{{ $usuario->fullname }}','Responsable', 'usuario_id');
        $grid->add('{{ date("d/m/Y", strtotime($fecha)); }}','Fecha', true);
        $grid->add('labor_dictada','Labor Dictada');
        $grid->add('labor_ejecutada','Labor Ejecutada');
        $grid->add('labor_pendiente','Labor Pendiente');
        $grid->add('observacion','Observación');
        $grid->edit(url().'/admin/labores/edit', 'Acciones','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('labores.listalabores', compact('filter', 'grid'));
    }

    public function ListaLaboresUser($user_id){
        $labores = Labores::with('usuario')->where('usuario_id', $user_id);
        $filter = DataFilter::source($labores);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('usuario.fullname','Responsable', 'usuario_id');
        $grid->add('{{ date("d/m/Y", strtotime($fecha)); }}','Fecha', true);
        $grid->add('labor_dictada','Labor Dictada');
        $grid->add('labor_ejecutada','Labor Ejecutada');
        $grid->add('labor_pendiente','Labor Pendiente');
        $grid->add('observacion','Observación');
        if(Entrust::hasRole('administracion')){
            $grid->edit(url().'/admin/labores/edit', 'Editar/Borrar','show|modify|delete');
        }
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('labores.listalabores', compact('filter', 'grid'));
    }

    public function CrudLabores(){
        $edit = DataEdit::source(new Labores());
        $edit->label('Labores');
        $edit->link("admin/labores/lista","Lista Labores", "TR")->back();
        $responsables = DB::table('usuarios')
                        ->select('nombre as resp_nombre', 'usuarios.id as usuario_id')
                        ->join('assigned_roles as a', 'usuarios.id', '=', 'a.user_id')
                        ->whereIn('a.role_id', array(9,8,7))
                        ->where('activo', true)
                        ->lists("resp_nombre", "usuario_id");
        $edit->add('usuario_id','Responsable','select')->options($responsables)->rule('required');
        $edit->add('fecha','Fecha', 'date')->rule('required');
        $edit->add('labor_dictada','Labor Dictada', 'textarea');
        $edit->add('labor_ejecutada','Labor Ejecutada', 'textarea');
        $edit->add('labor_pendiente','Labor Pendiente', 'textarea');
        $edit->add('observacion','Observación', 'textarea');


        return $edit->view('labores.crudlabores', compact('edit'));
    }

}