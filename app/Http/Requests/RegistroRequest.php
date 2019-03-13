<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
        //    dd($this->id);

        $rules = [];

        if ($this->request->has('name')) {
            $rules['name'] = ['required'];
        }

        if ($this->request->has('surname')) {
            $rules['surname'] = ['nullable'];
        }

        if ($this->request->has('phone')) {
            $rules['phone'] = ['required','regex:/^[6|7|8|9][0-9]{8}$/','max:9|min:9'];
        }

        if ($this->request->has('email')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->id.',id'];
        }

        if ($this->request->has('password')) {
            $rules['password'] = ['required', 'string', 'min:2', 'confirmed'];
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('Debes escribir un nombre para el usuario'),
            'email.required' => __('Debes escribir un email'),
            'email.email' => __('Debes escribir un email válido'),
            'email.unique' => __('El email ya existe'),
            'password.confirmed' => __('Las contraseñas deben coincidir'),
            'phone.*' => __('Debes escribir un teléfono válido'),
        ];
    }
}
