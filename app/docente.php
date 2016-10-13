<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class docente extends Model {

protected $table = 'docentes';
	//
	protected $fillable = ['dni', 'nombres', 'direccion', 'estadocivil', 'telefonos', 'email', 'estado'];
}
