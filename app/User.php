<?php namespace flavisur;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'tipo', 'ciudad', 'password', 'clave'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function matriculas()
	{
		return $this->hasMany('flavisur\matricula', 'user_id', 'id');
	}
	public function alumnos()
	{
		return $this->hasMany('flavisur\Alumno', 'user_id', 'id');
	}
	public function perfil()
	{
		return $this->hasMany('flavisur\perfil', 'user_id', 'id');
	}
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}	
	public function setClaveAttribute($value)
	{
		$this->attributes['clave'] = \Crypt::encrypt($value);
	}
	public function getClavesssAttribute()
	{
		if($this->clave !="")
		{
			$mostrar =\Crypt::decrypt($this->clave);
			return $mostrar;
		}
	}
	public function scopeUsuario($query, $usuario)
	{
		if($usuario != "")
		{
			$query->where('name','Like', '%'.$usuario.'%');
		}
	}
}
