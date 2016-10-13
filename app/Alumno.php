<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model {

	protected $table = 'alumnos';
	//
	protected $fillable = ['dni', 'nombres', 'fec_nacimiento', 'sexo', 'distrito','provicincia','departamento',
							'direccion','telefono','email','cole_proce','trabaja','distrito_pro','provincia_pro','departamento_pro',
							'nom_apoderado', 'direccion_apo','distrito_apo','telefono_apo','cert_est_org','part_nac_org','copia_dni',
							'fotos','user_id','estado'];

	public function users()
	{
		return $this->belongsTo('flavisur\User');
	}
	public function matriculas()
	{
		return $this->hasMany('flavisur\matricula');
	}
	public function scopeNombres($query, $nombres)
	{
		if($nombres != "")
		{
			$query->where('nombres','Like', '%'.$nombres.'%');
		}
	}
	public function scopeDNI($query, $dni)
	{
		if($dni !="")
		{
			$query->where('dni', $dni);
		}
	}
	public function getEdadAttribute()
	{
		return \Carbon\Carbon::parse($this->fec_nacimiento)->age;
	}
}
