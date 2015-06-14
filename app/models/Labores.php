<?php

class Labores extends Eloquent  {

	public $table = 'labores';
	public $timestamps = false;

	public function usuario(){
        return $this->belongsTo('Usuario', 'usuario_id');
    }

}