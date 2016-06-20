<?php

class Matricula extends Eloquent {


	public $table = 'matricula';

    protected $appends = array('totalpago');

    public function getTotalpagoAttribute(){
        return $this->primera_cuota + $this->segunda_cuota;
    }

	public function usuario(){
	return $this->belongsTo('Usuario', 'usuario_id');
	}




}