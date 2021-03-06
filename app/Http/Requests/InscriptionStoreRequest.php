<?php

namespace App\Http\Requests;

class InscriptionStoreRequest extends Request
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
        'id_academic_period' => 'required',
        'cod_modalidad'      => 'required'
        /*'ape_pat'          => 'required',
        'ape_mat'            => 'required',
        'cod_doc_tip'        => 'required',
        'num_doc'            => 'required',
        'correo'             => 'required',
        'direccion'          => 'required',
        'cod_pais'           => 'required',
        'cod_dpto'           => 'required',
        'cod_prov'           => 'required',
        'cod_dist'           => 'required',
        'num_cellphone'      => 'required',
        'num_phone'          => 'required',
        'proteccion_datos'   => 'required',
        'cod_modalidad'      => 'required',
        'cod_esp_tipo'       => 'required',
        'cod_esp'            => 'required',*/
      ];
    }

    /**
     * Get Custom Message
     * @return array
     */
    public function messages()
    {
        return [
            'id_academic_period' => 'Es necesario seleccione la fecha de inicio',
            'cod_modalidad'      => 'Es necesario seleccionar la modalidad'
            /*'nombre.required'             => 'Es necesario ingresar el nombre',
            'ape_pat.required'            => 'Es necesario ingresar el apellido paterno',
            'ape_mat.required'            => 'Es necesario ingresar el apellido materno',
            'cod_doc_tip.required'        => 'Es necesario seleccionar el tipo de documento',
            'num_doc.required'            => 'Es necesario ingresar el número de DNI',
            'correo.required'             => 'Es necesario ingresar el correo electrónico',
            'direccion.required'          => 'Es necesario ingresar la dirección',
            'cod_pais.required'           => 'Es necesario seleccionar el país',
            'cod_dpto.required'           => 'Es necesario seleccionar el departamento',
            'cod_prov.required'           => 'Es necesario seleccionar la provincia',
            'cod_dist.required'           => 'Es necesario seleccionar el distrito',
            'num_cellphone.required'      => 'Es necesario ingresar el teléfono fijo',
            'num_phone.required'          => 'Es necesario ingresar el teléfono celular',
            'proteccion_datos.required'   => 'Es necesario aceptar los terminos y condiciones',
            'id_academic_period.required' => 'Es necesario seleccione la fecha de inicio',
            'cod_modalidad.required'      => 'Es necesario seleccionar la modalidad',
            'cod_esp_tipo.required'       => 'Es necesario seleccionar el tipo de especialización',
            'cod_esp.required'            => 'Es necesario seleccionar la especialización',*/
        ];
    }


}
