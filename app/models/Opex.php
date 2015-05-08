<?php


class Opex extends Eloquent  {


	public $table = 'opex';
	public $timestamps = true;

	public function usuario(){
        return $this->belongsTo('Usuario', 'id_usuario');
    }

    public function catopex(){
        return $this->belongsTo('CatOpex', 'id_cat_opex');
    }

}