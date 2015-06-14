<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	protected $appends = array('fullname');

	public function getFullnameAttribute(){
        return ucfirst($this->nombre) ." ". ucfirst($this->apellido_paterno). " (".$this->email.")";
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
     */

	public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function examenes(){
        return $this->hasMany('Examen');
    } 

    public function assigned(){
        return $this->hasMany('Assigned', 'user_id');
    } 

    public function plan(){
        return $this->belongsTo('Planes', 'id_plan');
    } 
	

	protected $hidden = array('password', 'remember_token');

}
