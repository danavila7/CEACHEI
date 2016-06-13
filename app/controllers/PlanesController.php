<?php

class PlanesController extends BaseController
{
    protected $layout = 'layouts.layout';

     public function ListaPlanes(){
        $filter = DataFilter::source(new Planes);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->add('valor','Valor', true);
        $grid->edit(url().'/admin/planes/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/admin/planes/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('usuarios.listaplanes', compact('filter', 'grid'));
    }

    public function CrudPlan(){
        $edit = DataEdit::source(new Planes());
        $edit->label('Planes');
        $edit->link("admin/planes","Lista Planes", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('valor','Valor', 'text')->rule('required');

        return $edit->view('usuarios.crudplan', compact('edit'));
    }

}