<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class carrera extends Model {

	protected $table = 'carreras';
	protected $fillable = ['nombre', 'descripcion', 'tipo', 'duracion', 'estado'];

	public function semestres()
	{
		//dd('ingreso');
		return $this->hasMany('flavisur\semestre','carrera_id', 'id');
	}
	public function getFullNameAttribute()
	{
		return '#';		
	}
	public function matriculas()
	{
		return $this->hasMany('flavisur\matricula');
	}
}
