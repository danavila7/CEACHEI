<?php

class CatCapex extends Eloquent {


	public $table = 'cat_capex';
	public $timestamps = false;
	
	public function capex(){
	return $this->belong_to('Capex');
	}


}