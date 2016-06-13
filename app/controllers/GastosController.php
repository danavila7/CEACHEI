<?php

class GastosController extends BaseController
{
	protected $layout = 'layouts.layout';

   public function ListaGastosAcma(){
        $filter = DataFilter::source(new GastosAcma);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('bol_fact','Buscar por Boleta/Factura', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('gastos.lista', compact('filter', 'grid'));
    }

    public function CrudGastosAcma(){

        $edit = DataEdit::source(new GastosAcma());
        $edit->link("admin/gastosacma","Lista Gastos", "TR")->back();
        $edit->add('monto','Monto', 'text')->rule('required');
        $edit->add('fondo','Fondo', 'text')->rule('required');
        $edit->add('fecha','Fecha', 'date')->rule('required');
        $edit->add('descripcion','Descripción', 'textarea')->rule('required');
        $edit->add('bol_fact','Boleta/Factura', 'text')->rule('required');
        $edit->add('responsable','Responsable', 'text')->rule('required');
        $edit->add('autorizador','Autorizador', 'text')->rule('required');
        $edit->add('foto','Foto', 'image')
                        ->rule('mimes:jpeg,png,jpg')
                        ->move('uploads/respaldo/');

        return View::make('gastos.crud', compact('edit'));
    }

}