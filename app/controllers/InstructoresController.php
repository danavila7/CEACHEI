<?php

class InstructoresController extends BaseController
{
    protected $layout = 'layouts.layout';

    public ListarInstructores(){

        $user = Usuario::with('plan', 'assigned')
                            ->join('assigned_roles', 'assigned_roles.user_id','=','usuarios.id')
                            ->join('roles', 'roles.id','=','assigned_roles.role_id')
                            ->where('roles.role_id', 9);

        $filter = DataFilter::source($user);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('nombre','Buscar por Nombre', 'text');
        $filter->add('created_at','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('search');
        $filter->reset('reset');

        $grid = DataSet::source($filter);
        $grid->orderBy('apellido_paterno','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('instructores.lista_instructores', compact('filter', 'grid'));
    }

}