<?php namespace flavisur;

use Illuminate\Database\Eloquent\Model;

class matricula extends Model {

	protected $table = 'matriculas';
	protected $fillable = ['carrera_id','alumno_id', 'modulo_id', 'fecha_matricula', 'user_id', 'nroboleta', 'ciudad', 'estado'];

	public function detalles_matriculas()
	{
		return $this->hasMany('flavisur\detalle_matricula', 'matricula_id');
	}
    public function inscripciones()
    {
        return $this->hasMany('flavisur\inscripcion', 'matricula_id', 'id');
    }
	public function carreras()
	{
		return $this->belongsto('flavisur\carrera','carrera_id');
	}
	public function alumnos()
	{
		return $this->belongsto('flavisur\Alumno','alumno_id');
	}
	public function users()
	{
		return $this->belongsto('flavisur\User', 'user_id');
	}
	public function delete_detalle()
    {
        // Borra todos los comentarios 
        //dd($this->detalles_matriculas);
        foreach($this->detalles_matriculas as $detalles)
        {
            $detalles->delete();
        }
    }
    public function getNameGrupoAttribute()
    {
    	
    	foreach ($this->detalles_matriculas as $detalles) {
    		return($detalles->grupos->nombre_unidad);
    	}
    }
    public function getInicioGrupoAttribute()
    {
        
        foreach ($this->detalles_matriculas as $detalles) {
            return($detalles->grupos->inicio);
        }
    }
    public function getNameCicloAttribute()
    {
    	foreach ($this->detalles_matriculas as $detalles) {
    		return($detalles->grupos->ciclos->ciclo);
    	}
    }
    public function getHorarioAttribute()
    {
        foreach ($this->detalles_matriculas as $detalles) {
            return($detalles->grupos->Horario);
        }
    }
    public function scopeNombreMatricula($query, $nombres)
    {
        
        if($nombres != "")
        {
            $query->whereHas('alumnos', function($q) use ($nombres){
                $q->where('nombres', 'LIKE', '%'.$nombres.'%');
            });
        }
    }
}
