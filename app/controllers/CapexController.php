<?php

class CapexController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';
    
   public function ListaCatCapex(){
        $filter = DataFilter::source(new CatCapex);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->edit(url().'/catcapex/edit', 'Editar/Borrar','modify|delete');
        $grid->link('/catcapex/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('capex.listacatcapex', compact('filter', 'grid'));
    }

    public function CrudCatCapex(){
        $edit = DataEdit::source(new CatCapex());
        $edit->label('Categoría Capex');
        $edit->link("ListaCatCapex","Lista Categoría Capex", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');

        return View::make('capex.crudcatcapex', compact('edit'));
    }

    public function ListaCapex(){
        $filter = DataFilter::source(Capex::with('usuario', 'catcapex'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->link("indexcma","Panel de Control", "TR")->back();
        $filter->label('Capex - Gastos en Capital');
        $filter->add('num_boleta','Buscar por Boleta', 'text');
        $filter->add('num_factura','Buscar por Factura', 'text');
        $filter->add('producto','Buscar por Producto', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->link('ListaCatCapex', 'Lista Categoría', 'TR');
        $filter->submit('search');
        $filter->reset('reset');
        
        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-striped"));
        $grid->add('producto','Producto', true);
        $grid->add('num_boleta','Boleta', true);
        $grid->add('num_factura','Factura', true);
        $grid->add('monto','Monto', true);
        $grid->add('fecha|strtotime|date[d/m/Y]','Fecha', true);
        $grid->add('usuario.nombre','Encargado');
        $grid->add('catcapex.nombre','Categoría Capex');
        $grid->edit(url().'/capex/edit', 'Ver/Editar/Borrar','show|modify|delete');
        $grid->link('/capex/edit', 'Crear Nuevo', 'TR');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 
        $total = Capex::sum('monto');
        $total = Capex::sum('monto');
        $total_eduardo = Capex::where('id_usuario', 5)->sum('monto');
        $total_ceachei = Capex::where('id_usuario', 4)->sum('monto');
        return View::make('capex.listacapex', compact('filter','grid', 'total', 'total_eduardo', 'total_ceachei'));
    }

    public function CrudCapex(){
        $edit = DataEdit::source(new Capex());
        $edit->label('Capex - Gastos en Capital');
        $edit->link("ListaCapex","Lista Capex", "TR")->back();
        $edit->add('producto','Producto', 'text')->rule('required');
        $edit->add('num_boleta','Boleta', 'text');
        $edit->add('num_factura','Factura', 'text');
        $edit->add('monto','Monto', 'text');
        $edit->add('id_usuario','Encargado','select')->options(Usuario::where('permiso','Administrador')->lists('nombre', 'id'));
        $edit->add('id_cat_capex','Categoría Capex','select')->options(CatCapex::lists('nombre', 'id'));
        $edit->add('observacion','Observación', 'textarea');
        $edit->add('imagen','Imagen', 'image')
                        ->rule('mimes:jpeg,png')
                        ->move('uploads/respaldo/');
        $edit->add('fecha','Fecha', 'date')->rule('required')->format('d/m/Y', 'es');

        return View::make('capex.crudcatcapex', compact('edit'));
    }

   

}