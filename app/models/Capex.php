<?php

class Capex extends Eloquent  {

	public $table = 'capex';
	public $timestamps = true;

	public function usuario(){
        return $this->belongsTo('Usuario', 'id_usuario');
    }

    public function catcapex(){
        return $this->belongsTo('CatCapex', 'id_cat_capex');
    }

}