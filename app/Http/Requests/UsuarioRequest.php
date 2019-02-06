<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $rules = [];

        if ($this->request->has('name')) {
             $rules['name'] = ['required'];
        }
    
        if ($this->request->has('surname')) {
             $rules['surname'] = ['required'];
        }
    
        if ($this->request->has('phone')) {
             $rules['phone'] = ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'];
        }
    
        if ($this->request->has('email')) {
             $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->id.',id'];
        }
    
        if ($this->request->has('password')) {
             $rules['password'] = ['required', 'string', 'min:2', 'confirmed'];
        }
    
        if ($this->request->has('role')) {
             $rules['role'] = ['required',Rule::notIn(['0'])];
        }
    
        return $rules;
        // return [
        //     'name' => ['required'],
        //     'surname' => ['required'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->id.',id'],
        //     // 'email' => ['required', 'string', 'email', 'max:255'],
        //     'phone' => ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'],
        //     // 'password' => ['required', 'string', 'min:2', 'confirmed'],
        //     'role' => ['required',Rule::notIn(['0'])],
        //     // 'active'
        // ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Debes escribir un nombre para el usuario'),
            'surname.required' => __('Debes escribir los apellidos del usuario'),
            'role.*' => __('Debes seleccionar un role de usuario'),
            'email.required' => __('Debes escribir un email'),
            'email.email' => __('Debes escribir un email válido'),
            // 'email.unique' => __('El email ya existe'),
            'password.confirmed' => __('Las contraseñas deben coincidir'),
            'phone.*' => __('Debes escribir un teléfono válido'),
            '*.max' => __('Hay demasiados'),
        ];
    }
    
   
}
