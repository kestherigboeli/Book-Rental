<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'sometimes|required|email|unique:users',
            'password' => 'required|min:3',
        ];
    }


	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'password.confirmed' => 'Password does not match',
			'email.required' => 'Email is required',
			'email.unique' => 'Email is already taken',
		];
	}
}
