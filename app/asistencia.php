<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class asistencia extends Model {

	protected $table = 'asistencia';
	//
	protected $fillable = ['matricula_id', 'grupo_id', 'alumno_id', 'user_id', 'fecha'];

	public function grupos()
	{
		return $this->belongsto('flavisur\grupo','grupo_id');
	}
	public function users()
	{
		return $this->belongsto('flavisur\User', 'user_id');
	}
	public function alumnos()
	{
		return $this->belongsto('flavisur\Alumno', 'alumno_id');
	}
	public function getDiaAttribute()
	{
		$variable = date('l',strtotime($this->fecha));
		switch ($variable) {
			case 'Monday':
				$variable = 'Lunes';
				break;			
			case 'Tuesday':
				$variable = 'Martes';
				break;			
			case 'Wednesday':
				$variable = 'Miercoles';
				break;			
			case 'Thursday':
				$variable = 'Jueves';
				break;			
			case 'Friday':
				$variable = 'Viernes';
				break;			
			case 'Saturday':
				$variable = 'Sabado';
				break;			
			case 'Sunday':
				$variable = 'Domingo';
				break;
		}
		return $variable.' '.date('d/m/Y',strtotime($this->fecha));
	}
}
