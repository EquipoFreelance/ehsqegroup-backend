<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreHoraryRequest extends Request
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
            'cod_grupo'   => 'required',
            'cod_mod'     => 'required',
            'cod_docente' => 'required',
            'fec_inicio'  => 'required',
            'h_inicio'    => 'required',
            'h_fin'       => 'required',
            'cod_dia'     => 'required',
            'fec_fin'     => 'required',
            'num_horas'   => 'required',
            'activo'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cod_grupo.required'   => 'Es necesario seleccionar el Grupo',
            'cod_mod.required'     => 'Es necesario seleccionar el módulo',
            'cod_docente.required' => 'Es necesario seleccionar el docente',
            'fec_inicio.required'  => 'Es necesario ingresar la fecha de inicio',
            'fec_fin.required'     => 'Es necesario ingresar la fecha de finalización',
            'h_inicio.required'    => 'Es necesario ingresar la hora de inicio',
            'h_fin.required'       => 'Es necesario ingresar la hora de finalización',
            'cod_dia.required'     => 'Seleccione los días de la semana',
            'num_horas.required'   => 'Es necesario indicar el número de horas',
            'activo.integer'       => 'Solo esta permitido que sea números enteros'
        ];
    }
}
