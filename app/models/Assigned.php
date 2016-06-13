<?php


class Assigned extends Eloquent  {


	public $table = 'assigned_roles';
	public $timestamps = false;

	public function usuario(){
        return $this->belongsTo('Usuario', 'user_id');
    }

    public function catopex(){
        return $this->belongsTo('Role', 'role_id');
    }

}