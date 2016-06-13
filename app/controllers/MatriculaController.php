<?php

class MatriculaController extends BaseController
{
	protected $layout = 'layouts.layout';

   public function ListaMatricula(){
        $filter = DataFilter::source(Matricula::with('usuario'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('usuario.nombre','Alumno','text');
        $filter->add('created_at','Fecha Ingreso','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');


        $grid = DataGrid::source($filter);
        $grid->add('usuario.fullname','Alumno', 'usuario_id');
        $grid->add('primera_couta','Primera Cuota', true);
        $grid->add('segunda_cuota','Segunda Cuota', true);
        $grid->edit(url().'/admin/matriculas/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('matricula.lista', compact('filter', 'grid'));
    }

    public function CrudMatricula(){


        $edit = DataEdit::source(new Matricula());
        $edit->label('Ingresos Matricula');
        $edit->link("admin/matriculas","Lista Matricula", "TR")->back();
        $edit->add('primera_couta','Primera Cuota', 'text')->rule('required');
		$edit->add('segunda_cuota','Segunda Cuota', 'text')->rule('required');
        $edit->add('usuario.fullname','Alumno','autocomplete')
                ->remote('nombre', "id", url()."/searchuser")
                ->rule('required');

        return $edit->view('matricula.crud', compact('edit'));
    }

}