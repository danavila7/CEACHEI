<?php

class MatriculaController extends BaseController
{
	protected $layout = 'layouts.layout';

   public function ListaMatricula($incompleta = false){

        $matricula = Matricula::with('usuario', 'usuario.plan')
                        ->join('usuarios as u', 'u.id', '=', 'matricula.id')
                        ->where('u.activo', 1);
        $filter = DataFilter::source($matricula);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('usuario.id','ID Usuario','text');
        $filter->add('usuario.nombre','Alumno','text');
        $filter->add('created_at','Fecha Ingreso','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');
        $filter->build();


        $grid = DataGrid::source($filter);
        $grid->orderBy('u.apellido_paterno','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('matricula.lista', compact('filter', 'grid', 'incompleta'));
    }

    public function CrudMatricula(){


        $edit = DataEdit::source(new Matricula());
        $edit->label('Ingresos Matricula');
        $edit->link("admin/matriculas/lista","Lista Matricula", "TR")->back();
        $edit->add('primera_couta','Primera Cuota', 'text')->rule('required');
		$edit->add('segunda_cuota','Segunda Cuota', 'text')->rule('required');
        $edit->add('usuario.fullname','Alumno','autocomplete')
                ->remote('nombre', "id", url()."/admin/searchuser")
                ->rule('required');

        return $edit->view('matricula.crud', compact('edit'));
    }

}