<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class cursosemestre extends Model {

	protected $table = 'cursossemestres';
	//
	protected $fillable = ['curso_id', 'semestre_id', 'estado'];

	public function cursosemestres()
	{
		return $this->belongsTo('flavisur\semestre');
	}
 	public function getFullNameAttribute()
	{
		dd('prueba');
		//return '#';		
	}

}
