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

        if ($this->request->has('nombre')) {
             $rules['nombre'] = ['required'];
        }



        if ($this->request->has('contactEmail')) {
            $rules['contactEmail'] = ['string', 'email', 'max:255'];
        }
        if ($this->request->has('contactPhone')) {
            $rules['contactPhone'] = ['required','regex:/^[6|7|8|9][0-9]{8}$/','max:9|min:9'];
        }


        if ($this->request->has('cif')) {
            $rules['cif'] = ['required','regex:/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/','max:9','min:9','unique:ofertas,cif,'.$this->cif.',cif'];
        }
        if ($this->request->has('forma_id')) {
             $rules['forma_id'] = ['required'];
        }
        if ($this->request->has('socios')) {
             $rules['socios'] = ['integer'];
        }
        if ($this->request->has('empleados')) {
             $rules['empleados'] = ['integer'];
        }
        if ($this->request->has('año')) {
             $rules['año'] = ['digits:4','integer','min:1800','max:'.(date('Y')+1)];
        }
        if ($this->request->has('sector_id')) {
             $rules['sector_id'] = ['required'];
        }
        if ($this->request->has('valoracion')) {
             $rules['valoracion'] = ['regex:/^(\d+(?:[\,]\d{2})?)$/'];
        }
        if ($this->request->has('provincia_id')) {
             $rules['provincia_id'] = ['required'];
        }
        if ($this->request->has('poblacion_id')) {
             $rules['poblacion_id'] = ['required'];
        }
        if ($this->request->has('web')) {
             $rules['web'] = ['regex:/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/'];
        }
        if ($this->request->has('endeudamiento')) {
             $rules['endeudamiento'] = ['regex:/^(\d+(?:[\,]\d{2})?)$/'];
        }


        if ($this->request->has('asociacion')) {
             $rules['asociacion'] = ['required'];
        }
        if ($this->request->has('usuario')) {
             $rules['usuario'] = ['required'];
        }
        if ($this->request->has('usuario')) {
             $rules['provincia_id'] = ['required'];
        }


        // if ($this->request->has('contactPhone')) {
        //      $rules['contactPhone'] = ['string','regex:^(\+34|0034|34)?[\s|\-|\.]?[6|7|8|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$^','max:9|min:9'];
        // }




        return $rules;
    }

    public function messages()
    {
        return [
            'nombre.*' => __('Debes un nombre para la oferta'),

            'contactPhone.*' => __('Debes escribir un teléfono válido'),
            'contactEmail.*' => __('Debes escribir un email válido'),


            'cif.unique' => __('El CIF ya existe'),
            'cif.required' => __('Debes escribir el CIF'),
            'cif.regex' => __('El CIF no tiene un formato válido'),
            'cif.min' => __('El CIF debe tener 9 dígitos'),
            'forma_id.*' => __('Debes seleccionar una forma jurídica'),
            'socios.*' => __('Debe ser un número'),
            'empleados.*' => __('Debe ser un número'),
            'año.*' => __('Debes escribir un ano válido'),
            'sector_id.*' => __('Debes seleccionar un sector'),
            'valoracion.*' => __('Debes dar un valor válido'),
            'provincia_id.*' => __('Debes seleccionar una provincia'),
            'poblacion_id.*' => __('Debes seleccionar una población'),
            'web.*' => __('Debes escribir una dirección web válida'),
            'endeudamiento.*' => __('Debes dar un valor válido'),

            '.*' => __('Debes escribir un ano válido'),


            'asociacion.required' => __('Debes seleccionar una asociación'),
            'usuario.required' => __('Debes seleccionar un usuario'),
        ];
    }
    public function withValidator($validator)
    {


        // if ($validator->fails()) {

        // } else {


        // }

    }

}
