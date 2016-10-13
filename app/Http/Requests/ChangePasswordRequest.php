<?php namespace flavisur\Http\Requests;

use flavisur\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

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
			'clave_actual' => 'required|min:6|current_password',
            'password' => 'required|confirmed|min:6'
		];
	}
	public function messages()
    {
        return [];
    }
 
    /**
     * Get the sanitized input for the request.
     *
     * @return array
     */
    public function sanitize()
    {
        return $this->only('clave');
    }

}
