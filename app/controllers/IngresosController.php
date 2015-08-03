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


       public function ListaInfoFinanciero(){
        $filter = DataFilter::source(new InfoFinanciero);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->link("indexcma","Panel de Control", "TR")->back();
        $filter->label('Informe Financiero');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();
        
        $grid = DataGrid::source($filter);
        $grid->add('fecha','Fecha', true);
        $grid->add('monto','Monto', true);
        $grid->add('giro','Giro', true);
        $grid->add('transferencia','Transferencia', true);
        $grid->add('motivo','Motivo', true);
        $grid->add('saldo','Saldo', true);
        $grid->add('cc','CC', true);
        $grid->add('caja_chica','Caja Chica', true);
        $grid->add('total','Total', true);
        if(Entrust::hasRole('superadmin')){
        $grid->link('/infofinanciero/edit', 'Crear Nuevo', 'TR');
        $grid->edit(url().'/infofinanciero/edit', 'Editar/Borrar','modify|delete');
        }else
        $grid->edit(url().'/infofinanciero/edit', 'Ver','show');
        $grid->orderBy('id','desc');
        $grid->paginate(10); 

        return View::make('ingresos.listainfofinanciero', compact('filter', 'grid'));
    }

    public function CrudInfoFinanciero(){
        $edit = DataEdit::source(new InfoFinanciero());
        $edit->label('Informe Financiero');
        $edit->link("ListaInfoFinanciero","Lista Informe Financiero", "TR")->back();
        $edit->add('fecha','Fecha', 'date')->rule('required');
        $edit->add('monto','monto', 'text')->rule('required');
        $edit->add('giro','giro', 'text')->rule('required');
        $edit->add('transferencia','transferencia', 'text')->rule('required');
        $edit->add('motivo','motivo', 'textarea')->rule('required');
        $edit->add('saldo','saldo', 'text')->rule('required');
        $edit->add('cc','cc', 'text')->rule('required');
        $edit->add('caja_chica','caja_chica', 'text')->rule('required');
        $edit->add('total','total', 'text')->rule('required');
        $edit->add('foto','Foto', 'image')
                        ->rule('mimes:jpeg,png,jpg')
                        ->move('uploads/respaldo/');

        return $edit->view('ingresos.crudinfofinanciero', compact('edit'));
    }

}