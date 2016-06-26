<?php

class InfoFinancieroController extends BaseController
{
    protected $layout = 'layouts.layout';

    public function ListaInfoFinanciero(){
        $filter = DataFilter::source(new InfoFinanciero);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('transferencia','Transferencia', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->reset('Limpiar');
        $filter->build();

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('fecha','Fecha', true);
        $grid->add('monto','Monto', true);
        $grid->add('giro','Giro', true);
        $grid->add('transferencia','Transferencia', true);
        $grid->add('motivo','Motivo', true);
        $grid->add('saldo','Saldo', true);
        $grid->add('cc','CC', true);
        $grid->add('caja_chica','Caja Chica', true);
        $grid->add('total','Total', true);
        if(Entrust::hasRole('administracion')){
        $grid->edit(url().'/admin/infofinanciero/edit', 'Editar/Borrar','modify|delete');
        }else
        $grid->edit(url().'/admin/infofinanciero/edit', 'Ver','show');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('infofinanciero.lista', compact('filter', 'grid'));
    }

    public function CrudInfoFinanciero(){
        $edit = DataEdit::source(new InfoFinanciero());
        $edit->link("/admin/infofinanciero","Informe Financiero", "TR")->back();
        $edit->add('fecha','Fecha', 'date')->rule('required');
        $edit->add('monto','Monto', 'text')->rule('required');
        $edit->add('giro','Giro', 'text')->rule('required');
        $edit->add('transferencia','Transferencia', 'text')->rule('required');
        $edit->add('motivo','Motivo', 'textarea')->rule('required');
        $edit->add('saldo','Saldo', 'text')->rule('required');
        $edit->add('cc','CC', 'text')->rule('required');
        $edit->add('caja_chica','Caja Chica', 'text')->rule('required');
        $edit->add('total','Total', 'text')->rule('required');
        $edit->add('foto','Foto', 'image')
                        ->rule('mimes:jpeg,png,jpg')
                        ->move('uploads/respaldo/');

        return $edit->view('infofinanciero.crud', compact('edit'));
    }
}


