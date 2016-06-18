<?php

class MatriculaController extends BaseController
{
	protected $layout = 'layouts.layout';

   public function ListaMatricula($incompleta = false){

        if($incompleta){
            $matricula = Matricula::with('usuario')
                        ->where('segunda_cuota', '==', 0);
        }else{
            $matricula = Matricula::with('usuario');
        }

        $filter = DataFilter::source($matricula);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('usuario.id','ID Usuario','text');
        $filter->add('usuario.nombre','Alumno','text');
        $filter->add('created_at','Fecha Ingreso','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');


        $grid = DataGrid::source($filter);
        $grid->add('usuario.id','ID', 'usuario_id');
        $grid->add('<a href="#" data-id="{{ $usuario->id }}" class="link-to-user">{{ $usuario->fullname }}</a>','Alumno (click en el nombre para editar)', 'usuario_id');
        $grid->add('usuario.fecha_inscripcion','Fecha Inscripción Alumno', true);
        $grid->add('created_at','Fecha Ingreso Registro', true);
        $grid->add('primera_couta','Primera Cuota', true);
        $grid->add('segunda_cuota','Segunda Cuota', true);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->edit(url().'/admin/matriculas/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

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