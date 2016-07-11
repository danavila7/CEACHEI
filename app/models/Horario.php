<?php

class Horario extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'horarios';


    public function alumno(){
        return $this->belongsTo('Usuario', 'id_usuario');
    }

    public function instructor(){
        return $this->belongsTo('Usuario', 'id_instructor');
    }

}

?>