<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AsociacionRequest extends FormRequest
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

        if ($this->request->has('phone')) {
             $rules['phone'] = ['required_without:email','regex:/^[6|7|8|9][0-9]{8}$/','max:9|min:9','nullable'];
        }

        if ($this->request->has('address')) {
             $rules['address'] = ['required'];
        }

        if ($this->request->has('email')) {
             $rules['email'] = ['required_without:phone', 'string', 'email', 'max:255','nullable'];
        }

        if ($this->request->has('contact')) {
            $rules['contact'] = ['required'];
        }
        if ($this->request->has('contactEmail')) {
            $rules['contactEmail'] = ['required_without:contactPhone','string', 'email', 'max:255','nullable'];
        }
        if ($this->request->has('contactPhone')) {
            $rules['contactPhone'] = ['required_without:contactEmail','regex:/^[6|7|8|9][0-9]{8}$/','max:9|min:9','nullable'];
        }


        return $rules;
        // BORRAR
        // return [
        //     'name' => ['required'],
        //     'address',
        //     // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('asociacion','email')->ignore('info@cepyme.es')],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'phone' => ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'],
        //     // 'phone' => ['max:9'],
        //     'active'
        // ];
    }

    public function messages()
    {
        return [
            'contact.*' => __('Debes escribir una persona de contacto'),
            'contactPhone.*' => __('Debes escribir un teléfono válido'),
            'contactEmail.*' => __('Debes escribir un email válido'),

            'name.required' => __('Debes escribir un nombre de asociación'),
            'address.required' => __('Debes escribir una dirección'),
            'email.regex' => __('Debes escribir un email válido'),
            'email.required_without' => __('Debes escribir un email o un teléfono'),
            // 'email.string' => __('Debes escribir un email válido'),
            'phone.required_without' => __('Debes escribir un teléfono válido o un email de contacto'),
            'phone.regex' => __('Debes escribir un teléfono válido'),
            '*.max' => __('Hay demasiados'),
        ];
    }
    public function withValidator($validator)
    {
        if ($validator->fails()) {

        } else {


        }

    }

}
