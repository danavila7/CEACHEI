<?php

class Evaluaciones extends Eloquent {


	public $table = 'evaluaciones';
	public $timestamps = false;


	public function usuario(){
        return $this->belongsTo('Usuario', 'usuario_id');
    }

}