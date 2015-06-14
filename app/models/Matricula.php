<?php

class Matricula extends Eloquent {


	public $table = 'matricula';
	
	public function usuario(){
	return $this->belongsTo('Usuario', 'usuario_id');
	}


}