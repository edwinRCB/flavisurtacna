<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class detalle_matricula extends Model {
	//notas dew
	protected $table = 'detalles_matriculas';
	//se agrego de manera manual el campo user_id, sin usar migraciones de laravel
	protected $fillable = ['curso_id', 'grupo_id', 'matricula_id', 'pr_unidad','sg_unidad','tr_unidad','promedio', 'user_id'];
	//php-code-coverage
	public function cursos()
	{
		return $this->belongsto('flavisur\curso', 'curso_id', 'id');
	}
	public function grupos()
	{
		return $this->belongsto('flavisur\grupo', 'grupo_id', 'id');
	}
	public function matriculas()
	{
		return $this->belongsto('flavisur\matricula', 'matricula_id', 'id');
	}

	public function getNameGrupoAttribute()
    {
    	return $this->grupos->nombre_unidad;
    }
    public function getNameModuloAttribute()
    {
    	return $this->grupos->Ciclos->ciclo;
    }
    public function getIdCicloAttribute()
    {  
    	return $this->grupos->ciclo_id;
    }
}
