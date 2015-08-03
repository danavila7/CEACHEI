<?php

class MatriculaController extends BaseController
{
	protected $layout = 'layouts.layout';
    
   public function ListaMatricula(){
        $filter = DataFilter::source(Matricula::with('usuario'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->link("indexcma","Panel de Control", "TR")->back();
        $filter->label('Ingresos Matricula');
        $filter->add('created_at','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        
        $grid = DataGrid::source($filter);
        $grid->add('usuario.fullname','Alumno', 'usuario_id');
        $grid->add('primera_couta','Primera Cuota', true);
        $grid->add('segunda_cuota','Segunda Cuota', true);
        $grid->link('/matricula/edit', 'Crear Nuevo', 'TR');
        $grid->edit(url().'/matricula/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('matricula.listamatricula', compact('filter', 'grid'));
    }

    public function CrudMatricula(){


        $edit = DataEdit::source(new Matricula());
        $edit->label('Ingresos Matricula');
        $edit->link("ListaMatricula","Lista Matricula", "TR")->back();
        $edit->add('primera_couta','Primera Cuota', 'text')->rule('required');
		$edit->add('segunda_cuota','Segunda Cuota', 'text')->rule('required');
        $edit->add('usuario.fullname','Alumno','autocomplete')
                ->remote('nombre', "id", url()."/searchuser")
                ->rule('required');

        return $edit->view('matricula.crudmatricula', compact('edit'));
    }

}