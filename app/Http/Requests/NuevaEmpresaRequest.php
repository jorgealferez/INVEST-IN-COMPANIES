<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NuevaEmpresaRequest extends FormRequest
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


        if ($this->request->has('phone')) {
            $rules['phone'] = ['required_without:email','regex:/^[6|7|8|9][0-9]{8}$/','max:9|min:9','nullable'];
        }

        if ($this->request->has('email')) {
            $rules['email'] = ['required_without:phone', 'string', 'email' ,'nullable'];
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('Debes escribir un nombre para el usuario'),
            'email.required_without' => __('Debes escribir un email o un teléfono'),
            'email.regex' => __('Debes escribir un email válido'),
            'phone.required_without' => __('Debes escribir un teléfono válido o un email de contacto'),
            'phone.regex' => __('Debes escribir un teléfono válido'),
        ];
    }
}
