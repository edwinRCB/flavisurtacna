<?php namespace flavisur\Http\Requests;

use flavisur\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class alumnoRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'dni'=> 'required|unique:alumnos,dni',
			'nombres'=> 'required'
		];
	}
	public function messages()
    {
        return [
        	'dni.required' => 'El "DNI" es requerido...',
        	'dni.unique' => 'El "DNI" que ingreso ya esta registrado...',
        	'nombres.required' => 'El "Nombre" es requerido...',
        ];
    }
 
}
