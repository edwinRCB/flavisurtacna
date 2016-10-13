<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class detalle_inscripcion extends Model {

	protected $table = 'detalle_inscripciones';
	protected $fillable = ['curso_id', 'grupo_id', 'inscripcion_id', 'promedio'];

	public function inscripciones()
	{
		return $this->belongsto('flavisur\inscripcion', 'inscripcion_id', 'id');
	}
	public function grupos()
	{
		return $this->belongsto('flavisur\grupo', 'grupo_id', 'id');
	}
	public function cursos()
	{
		return $this->belongsto('flavisur\curso', 'curso_id', 'id');
	}
}
