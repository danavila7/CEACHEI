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
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->edit(url().'admin/catopex/edit', 'Acciones','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('opex.listacatopex', compact('filter', 'grid'));
    }

    public function CrudCatOpex(){
        $edit = DataEdit::source(new CatOpex());
        $edit->label('Categoría Opex');
        $edit->link("admin/opex/lista","Lista Categoría Opex", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');

        return View::make('opex.crudcatopex', compact('edit'));
    }



    public function ListaOpex(){
        $filter = DataFilter::source(Opex::with('usuario', 'catopex'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->label('Opex - Gastos Operacionales');
        $filter->add('num_boleta','Buscar por Boleta', 'text');
        $filter->add('num_factura','Buscar por Factura', 'text');
        $filter->add('producto','Buscar por Producto', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10);
        $grid->build();

        $total = Opex::sum('monto');
        $total_eduardo = Opex::where('id_usuario', 5)->sum('monto');
        $total_ceachei = Opex::where('id_usuario', 4)->sum('monto');

        return View::make('opex.listaopex', compact('filter','grid','total', 'total_eduardo', 'total_ceachei'));
    }

    public function CrudOpex(){
        $edit = DataEdit::source(new Opex());
        $edit->link("admin/opex/lista","Lista Opex", "TR")->back();
        $edit->add('producto','Producto', 'text')->rule('required');
        $edit->add('num_boleta','Boleta', 'text');
        $edit->add('num_factura','Factura', 'text');
        $edit->add('monto','Monto', 'text');
        $edit->add('id_usuario','Encargado','select')->options(Usuario::where('permiso','Administrador')->lists('nombre', 'id'));
        $edit->add('id_cat_opex','Categoría','select')->options(CatOpex::lists('nombre', 'id'));
        $edit->add('observacion','Observación', 'textarea');
        $edit->add('imagen','Imagen', 'image')
                        ->rule('mimes:jpeg,png')
                        ->move('uploads/respaldo/');
        $edit->add('fecha','Fecha', 'date')->format('d/m/Y', 'es');

        return View::make('opex.crudcatopex', compact('edit'));
    }

}