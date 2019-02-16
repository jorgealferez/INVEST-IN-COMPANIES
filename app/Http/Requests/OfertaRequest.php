<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OfertaRequest extends FormRequest
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

        if ($this->request->has('asociacion')) {
             $rules['asociacion'] = ['required'];
        }
        if ($this->request->has('usuario')) {
             $rules['usuario'] = ['required'];
        }
        if ($this->request->has('cif')) {
             $rules['cif'] = ['required','regex:/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/','max:9|min:9','unique:ofertas,cif,'.$this->cif.',cif'];
        }


        // if ($this->request->has('contactPhone')) {
        //      $rules['contactPhone'] = ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'];
        // }

        // if ($this->request->has('contactEmail')) {
        //      $rules['contactEmail'] = ['required', 'string', 'email', 'max:255'];
        // }



        return $rules;
    }

    public function messages()
    {
        return [
            'asociacion.required' => __('Debes seleccionar una asociación'),
            'usuario.required' => __('Debes seleccionar un usuario'),
            'cif.unique' => __('El CIF ya existe'),
            'cif.required' => __('Debes esacribir el CIF'),
            'cif.regex' => __('El CIF no tiene un formato válido'),
            'cif.min' => __('El CIF debe tener 9 dígitos'),
            // 'email.*' => __('Debes escribir un email válido'),
            // 'email.string' => __('Debes escribir un email válido'),
            // 'phone.*' => __('Debes escribir un teléfono válido'),
            '*.max' => __('Hay demasiados dígitos'),
        ];
    }
    public function withValidator($validator)
    {


        // if ($validator->fails()) {

        // } else {


        // }

    }

}
