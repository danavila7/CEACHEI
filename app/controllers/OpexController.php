<?php

class OpexController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';
    
   public function ListaCatOpex(){
        $filter = DataFilter::source(new CatOpex);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->edit(url().'/catopex/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/catopex/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('opex.listacatopex', compact('filter', 'grid'));
    }

    public function CrudCatOpex(){
        $edit = DataEdit::source(new CatOpex());
        $edit->label('Categoría Opex');
        $edit->link("ListaCatOpex","Lista Categoría Opex", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');

        return View::make('opex.crudcatopex', compact('edit'));
    }



    public function ListaOpex(){
        $filter = DataFilter::source(Opex::with('usuario', 'catopex'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->link("indexcma","Panel de Control", "TR")->back();
        $filter->label('Opex - Gastos Operacionales');
        $filter->add('num_boleta','Buscar por Boleta', 'text');
        $filter->add('num_factura','Buscar por Factura', 'text');
        $filter->add('producto','Buscar por Producto', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->link('ListaCatOpex', 'Lista Categoría', 'TR');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('producto','Producto', true);
        $grid->add('num_boleta','Boleta', true);
        $grid->add('num_factura','Factura', true);
        $grid->add('monto','Monto', true);
        $grid->add('fecha|strtotime|date[d/m/Y]','Fecha', true);
        $grid->add('usuario.nombre','Encargado');
        $grid->add('catopex.nombre','Categoría Opex');
        $grid->edit(url().'/opex/edit', 'Ver/Editar/Borrar','show|modify|delete');
        $grid->link('/opex/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 
        return View::make('opex.listaopex', compact('filter','grid'));
    }

    public function CrudOpex(){
        $edit = DataEdit::source(new Opex());
        $edit->label('Opex - Gastos Operacionales');
        $edit->link("ListaOpex","Lista Opex", "TR")->back();
        $edit->add('producto','Producto', 'text')->rule('required');
        $edit->add('num_boleta','Boleta', 'text');
        $edit->add('num_factura','Factura', 'text');
        $edit->add('id_usuario','Encargado','select')->options(Usuario::where('permiso','Administrador')->lists('nombre', 'id'));
        $edit->add('id_cat_opex','Categoría','select')->options(CatOpex::lists('nombre', 'id'));
        $edit->add('observacion','Observación', 'textarea')->rule('required');
        $edit->add('imagen','Imagen', 'image')
                        ->rule('mimes:jpeg,png')
                        ->move('uploads/respaldo/');
        $edit->add('fecha','Fecha', 'date')->rule('required');

        return View::make('opex.crudcatopex', compact('edit'));
    }

}