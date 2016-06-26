<?php

class PlanesController extends BaseController
{
     public function ListaPlanes(){
        $filter = DataFilter::source(new Planes);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->add('valor','Valor', true);
        $grid->edit(url().'/admin/planes/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','nombre');
        $grid->paginate(10);

        return View::make('planes.lista', compact('filter', 'grid'));
    }

    public function CrudPlan(){
        $edit = DataEdit::source(new Planes());
        $edit->label('Planes');
        $edit->link("admin/planes","Lista Planes", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('valor','Valor', 'text')->rule('required');

        return $edit->view('planes.crud', compact('edit'));
    }

}