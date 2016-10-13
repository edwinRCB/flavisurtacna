<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class pago extends Model {

	protected $table = 'pago';
	protected $fillable = ['alumno_id', 'semestre_id', 'user_id', 'nro_pension', 'tipo', 'turno', 
							'aula', 'nroboleta', 'estado'];

	public function alumnos()
	{
		return $this->belongsTo('flavisur\alumno');
	}
	public function semestres()
	{
		return $this->belongsTo('flavisur\semestre');
	}

}
