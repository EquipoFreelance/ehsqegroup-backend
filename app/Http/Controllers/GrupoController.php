<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Sede;
use App\Models\Grupo;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GrupoController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(){
        return "asdasd";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      $data = ['sedes' => Sede::lists('nom_sede', 'id')];
      return view('grupo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      // Enviando los parametros necesarios para la validación
      $validator = Validator::make( $request->all(), $this->validateRules(), $this->validateMessages() );

      // Si existen errores el Sistema muestra un mensaje
      if ($validator->fails()){

        // Enviando Mensaje
        return redirect()->route('dashboard.grupo.create')->withErrors($validator)
        ->withInput();

      } else {
          //Enviando mensaje
          return redirect()->route('dashboard.grupo.index')
          ->with('message', 'Los datos se registraron satisfactoriamente');
      }

    }

    /* Reglas de validaciones */
    public function validateRules()
    {

      /* Aplicando validación al Request */

      // Reglas de validación
      $rules = [
        'nom_grupo'   => 'required',
        'cod_sede'    => 'required',
        'descripcion' => 'required',
        'fe_inicio'   => 'required',
        'fe_fin'      => 'required',
        'num_min'     => 'required',
        'num_max'     => 'required',
        'activo'      => 'required'
      ];

      return $rules;

    }

    /* Mensaje personalizado */
    public function validateMessages()
    {

      // Mensaje de validación Personalizado
      $messages = [
        'nom_grupo.required'   => 'Es necesario ingresar el nombre del grupo',
        'cod_sede.required'    => 'Seleccione el la sede',
        'descripcion.required' => 'Es necesario ingresar la descripción',
        'fe_inicio.required'   => 'Es necesario ingresar la fecha de inicio',
        'fe_fin.required'      => 'Es necesario ingresar la fecha de finalizacion',
        'num_min.required'     => 'Es necesario ingresar el número mínimo de alumnos',
        'num_max.required'     => 'Es necesario ingresar el número máximo de alumnos',
        'activo.required'      => 'Es necesario indicar si el grupo estará activo o inactivo',
        //'activo.integer'       => 'Solo esta permitido que sea números enteros'
      ];

      return $messages;
    }

}
