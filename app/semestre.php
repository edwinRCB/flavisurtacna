<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class semestre extends Model {

	protected $table = 'semestres';
	protected $fillable = ['carrera_id', 'ciclo', 'estado'];

	public function carreras()
	{
		return $this->belongsTo('flavisur\carrera', 'carrera_id', 'id');
	}
	public function cursosemestre()
	{
		return $this->hasMany('flavisur\cursosemestre', 'semestre_id', 'id');
	}
	public function cursos()
	{
		return $this->belongsToMany('flavisur\curso', 'cursossemestres');
	}
	public function prueba()
	{
		return 'ingresa aqui';
	}
}
