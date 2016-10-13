<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class curso extends Model {

	protected $table = 'cursos';
	//
	protected $fillable = ['nombre', 'descripcion', 'creditos', 'estado'];

	public function semestres()
	{
		return $this->belongsToMany('flavisur\semestre', 'cursossemestres');
	}
	public function detalles_matriculas()
	{
		return $this->hasMany('flavisur\detalle_matricula', 'curso_id', 'id');
	}
}
