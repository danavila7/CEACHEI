<?php

class IngresosController extends BaseController
{
	protected $layout = 'layouts.layout';
    
   public function ListaIngresosAcma(){
        $filter = DataFilter::source(new IngresosAcma);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->link("indexcma","Panel de Control", "TR")->back();
        $filter->label('Ingresos ACMA');
        $filter->add('recepcionado_por','Buscar por Recepcionado', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();
        
        $grid = DataSet::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10); 
        $grid->build();

        return View::make('ingresos.listaingresosacma', compact('filter', 'grid'));
    }

    public function CrudIngresosAcma(){


        $edit = DataEdit::source(new IngresosAcma());
        $edit->label('Ingresos ACMA');
        $edit->link("ListaIngresosAcma","Lista Ingresos", "TR")->back();
        $edit->add('fecha','Fecha', 'date')->rule('required');
		$edit->add('descripcion','Descripción', 'textarea')->rule('required');
        $edit->add('monto','Monto', 'text')->rule('required');
        $edit->add('saldo','Saldo', 'text')->rule('required');
        
        
        $edit->add('tipo_pago','Tipo Pago', 'text')->rule('required');
        $edit->add('recepcionado_por','Recepcionado', 'text')->rule('required');
        $edit->add('foto','Foto', 'image')
                        ->rule('mimes:jpeg,png,jpg')
                        ->move('uploads/respaldo/');

        return View::make('ingresos.crudingresosacma', compact('edit'));
    }

}