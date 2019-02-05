<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
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
        return [
            'name' => ['required'],
            'address',
            // 'email' => ['required', 'string', 'email', 'max:255', Rule::unique('asociacion','email')->ignore('info@cepyme.es')],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'],
            // 'phone' => ['max:9'],
            'active'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Debes escribir un nombre de asociación'),
            'email.*' => __('Debes escribir un email válido'),
            // 'email.string' => __('Debes escribir un email válido'),
            'phone.*' => __('Debes escribir un teléfono válido'),
            '*.max' => __('Hay demasiados'),
        ];
    }
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return "FDFD";
        } else {

            return "adsadaasds";
        }

    }
   
}
