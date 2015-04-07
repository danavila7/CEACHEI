<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ExamenPregunta extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public $table = 'examenpreguntas';
	
	public function Examen(){
	return $this->has_many('Examen');
	}
	
	public function Pregunta(){
	return $this->has_many('Pregunta');
	}

}
