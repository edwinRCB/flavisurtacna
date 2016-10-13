<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class modeloAlumnoNotas extends Model {

	protected $table = 'alumnos';
	//
	protected $fillable = ['dni', 'nombres', 'OPERACION', 'MATTO', 'INGLES', 'SEGURIDAD', 'PRACTICA'];

}