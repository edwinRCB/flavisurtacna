<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class perfil extends Model {

	protected $table = 'perfiles';
	protected $fillable = ['dni', 'tipousuario', 'direccion', 'telefonos', 'user_id'];

}
