<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class inscripcion extends Model {

	protected $table = 'inscripciones';
	protected $fillable = ['matricula_id', 'grupo_id', 'fecha_inscripcion','estado'];

	public function detalle_inscripciones()
	{
		return $this->hasMany('flavisur\detalle_inscripcion', 'inscripcion_id', 'id');
	}
	public function matriculas()
	{
		return $this->belongsto('flavisur\matricula', 'matricula_id', 'id');
	}
	public function grupos()
	{
		return $this->belongsto('flavisur\grupo', 'grupo_id', 'id');
	}

}
