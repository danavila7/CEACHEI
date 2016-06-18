<?php

class Clases extends Eloquent  {

	public $table = 'clases';
	public $timestamps = false;

	public function usuario(){
        return $this->belongsTo('Usuario', 'usuario_id');
    }

    public function instructor(){
        return $this->belongsTo('Usuario', 'instructor_id');
    }

}