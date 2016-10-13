<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model {

	protected $table = 'grupos';
	protected $fillable =['carrera_id','ciclo_id','nombre_unidad','Horario','inicio','fin','ciudad', 'Local','estado'];

	public function detalles_matriculas()
	{
		return $this->hasMany('flavisur\detalle_matricula','grupo_id', 'id');
	}
	public function carreras()
	{
		return $this->belongsto('flavisur\carrera', 'carrera_id', 'id');
	}
	public function ciclos()
	{
		return $this->belongsto('flavisur\semestre', 'ciclo_id', 'id');
	}
	public function detalles_grupos()
	{
		return $this->hasMany('flavisur\detalle_grupo', 'grupo_id', 'id');
	}
	public function scopeCarrera($query, $carrera_id)
	{

		if($carrera_id != 0)
		{
			$query->whereHas('carreras', function($q) use ($carrera_id){
				$q->where('id', $carrera_id);
			});
		}
	}
	public function scopeModulo($query, $modulo_id)
	{
		if($modulo_id !=0)
		{
			$query->whereHas('ciclos', function($q) use ($modulo_id){
				$q->where('id', $modulo_id);
			});
		}
	}

}
