<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class detalle_grupo extends Model {

	protected $table = 'detalles_grupos';
	protected $fillable = ['grupo_id', 'curso_id', 'user_id', 'estado'];

	public function cursos()
	{
		return $this->belongsto('flavisur\curso', 'curso_id', 'id');
	}
	public function users()
	{
		return $this->belongsto('flavisur\User', 'user_id', 'id');
	}
	public function grupos()
	{
		return $this->belongsto('flavisur\grupo', 'grupo_id', 'id');
	}
}
