<?php

namespace App\Http\Controllers\WebService;

use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\ReportCard;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Http\Requests;

class WSReportCardController extends Controller
{
    /**
     * Lista de reporte de notas
     * @param $id_group
     * @param $id_module
     * @return \Illuminate\Http\JsonResponse
     */
    public function ReportCardEnrollment($id_group, $id_module)
    {

        $group = Grupo::find($id_group);
        $header  = '';
        $body    = '';
        $builder = [];

        if($group){

            if($group->group_enrollment){

                foreach ($group->group_enrollment as $item) {

                    $enrollment = Enrollment::find($item->id_enrollment);

                    $body[] = array(
                        "id"     => $item->id_enrollment,
                        "name"   => $enrollment->student->persona->nombre.", ".$enrollment->student->persona->ape_pat." ".$enrollment->student->persona->ape_mat,
                        "report" => $this->ReportCardModules($item->id_enrollment, $id_module, $group, $header)
                    );

                }

            }

            // Generando la cabecera del listado
            foreach ($group->group_horary as $horary) {
                if($horary->cod_mod == $id_module) {
                    for ($n = 1; $n <= $horary->num_taller; $n++)
                    $header[] = array("title" => "Taller " . $n);
                    break;
                }
            }

        }


        $builder = array("body" => $body, "header" => $header);

        return response()->json(array("response" => $builder), 200);

    }

    /**
     * Lista las notas dependiendo el modulo seleccionado
     * @param $id_enrollment
     * @param $id_module
     * @param $group
     * @param $header
     * @return array
     */
    public function ReportCardModules($id_enrollment, $id_module, $group, &$header)
    {
        $rows = [];

        foreach ($group->group_horary as $horary) {

            if($horary->cod_mod == $id_module)
            {

                for ($n = 1; $n <= $horary->num_taller; $n++)
                {

                    // Muestra la nota registrada anteriormente
                    $report_card = ReportCard::where("cod_matricula", $id_enrollment)
                        ->where("cod_modulo", $id_module)
                        ->where("cod_taller", $n)
                        ->select('id', 'num_nota', 'cod_taller')->first();

                    // Si existe lo mostramos
                    if($report_card){

                        if(fmod($report_card->num_nota, 1) !== 0.00){
                            // your code if its decimals has a value
                            $nota = number_format($report_card->num_nota, 1, '.', '');
                        } else {
                            $nota = number_format($report_card->num_nota, 0, '.', '');
                        }

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'            => $report_card->id,
                                    'num_nota'      => $nota,//$report_card->num_nota,
                                    'cod_matricula' => $report_card->cod_matricula,
                                    'cod_taller'    => $n
                                ]
                        );

                    // Caso contrario colocamos los valores en cero
                    }else{

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'            => 0,
                                    'num_nota'      => false,
                                    'cod_matricula' => $id_enrollment,
                                    'cod_taller'    => $n
                                ]
                        );

                    }


                }

                break;
            }

        }

        return $rows;

    }

    public function ReporteCardStore(Request $request){

        $ids            = $request->get("id_num_nota");
        $cod_grupo      = $request->get("group");
        $ids_matricula  = $request->get("id_matricula");
        $cod_modulo     = $request->get("cod_mod");
        $ids_taller     = $request->get("id_taller");

        $teacher    = Docente::where("cod_persona", Auth::user()->cod_persona )->first();

        foreach ($request->get("num_nota") as $key => $value)
        {
            if($value >= 0 && $value != ''){

                if($ids[$key] > 0){

                    $rc = ReportCard::findOrFail($ids[$key]);

                    if($rc){

                        if($rc->num_nota != $value)
                        {
                            $rc->fill(['num_nota' => $value])->save();
                            print "Actualizado \n";
                        }else{
                            print "No es necesario hacer esfuerzo \n";
                        }

                    }

                } else {

                    $new_report_card = new ReportCard;
                    $new_report_card->fill(
                        [
                            'num_nota'      => $value,
                            'cod_matricula' => $ids_matricula[$key],
                            'cod_taller'    => $ids_taller[$key],
                            'cod_grupo'     => $cod_grupo,
                            'cod_modulo'    => $cod_modulo,
                            'cod_docente'   => $teacher->id,
                            'created_by'    => Auth::user()->id,
                            'created_at'    => Carbon::now(),
                        ]
                    )->save();

                }

                /*if($rc){

                    if($rc->num_nota != $value)
                    {
                        $rc->fill(['num_nota' => $value])->save();
                        print "Actualizado \n";
                    }else{
                        print "No es necesario hacer esfuerzo \n";
                    }

                } else {

                    $new_report_card = new ReportCard;
                    $new_report_card->fill(
                        [
                            'num_nota'    => $value,
                            'cod_grupo'   => $cod_grupo,
                            'cod_modulo'  => $cod_modulo,
                            'cod_docente' => $teacher->id,
                            'created_by'  => Auth::user()->id,
                            'created_at'  => Carbon::now(),
                        ]
                    )->save();
                    //print "Nueva nota registrada \n";

                }*/

            }else if( $value == ''){

               //print "No hace nada:".$value." - Id:".$ids[$key]."\n";
                //print "Nota:".$value." - Id:".$ids[$key]."\n";
            }

        }


    }

}
