<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitacaoRequest extends FormRequest
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
            'namesolicitante'   => 'required',
            'nameramal'         => 'required|min:4',
            'nameroteiro'       => 'required',
            'namefinalidade'    => 'required',
            'datahorasaida'     => 'required',
            'datahoraretorno'   => 'required|date|after_or_equal:datahorasaida',
            'nameusuario'       => 'required',
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
            'namesolicitante.required' => 'Por favor informe o setor solicitante.',
            'nameramal.required'       => 'Por favor informe o ramal do seu setor.',
            'nameramal.min'            => 'O ramal deve conter no mínimo 4 dígitos',
            'nameroteiro.required'     => 'Por favor informe o roteiro.',
            'namefinalidade.required'  => 'Por favor informe a finalidade desta solicitação.',
            'datahorasaida.required'   => 'Por favor informe a data e hora de saída.',
            'datahoraretorno.required' => 'Insira uma data e hora de retorno mesmo que não necessite retornar.',
            'datahoraretorno.after_or_equal' => 'Desculpe! Não possuímos um DeLorean? A data e hora de retorno não podem ser anterior à data e hora de saída.',
            'nameusuario.required'     => 'Por favor informe o mome do solicitante ou paciente.',
        ];
    }
}
