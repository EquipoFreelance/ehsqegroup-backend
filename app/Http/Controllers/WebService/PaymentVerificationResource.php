<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 29/01/2017
 * Time: 02:00 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\AcademicPeriodRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\EspecializationTypeRepository;
use App\Repositories\Eloquents\EnrollmentBillingClientRepository;

use App\Repositories\Eloquents\ModalityRepository;
use App\Repositories\Eloquents\PaymentTypeRepository;
use Illuminate\Http\Request;



class PaymentVerificationResource  extends Controller
{
    private $rep;
    private $rmod;
    private $resp;
    private $respt;
    private $rap;
    private $rebr;
    private $epmr;
    private $rpt;

    public function __construct(
        EnrollmentRepository $rep,
        ModalityRepository $rmod,
        EspecializationRepository $resp,
        EspecializationTypeRepository $respt,
        AcademicPeriodRepository $rap,
        EnrollmentBillingClientRepository $rebr,
        EnrollmentPMRepository $epmr,
        PaymentTypeRepository $rpt
    )
    {
        $this->rep   = $rep;
        $this->resp  = $resp;
        $this->respt = $respt;
        $this->rmod  = $rmod;
        $this->rap   = $rap;
        $this->rebr  = $rebr;
        $this->epmr  = $epmr;
        $this->rpt   = $rpt;
    }

    public function index(Request $request){

        $q = $request->get("q");

        $response = array();

        if($q == "ALL"){

            $items = $this->rep->getEnrollmentByPeriodicAcademic();

            foreach ($items as $item) {

                // Find Person
                $find_enrollment = $this->rep->getById($item->id);

                // Find Billing Client
                $find_billing_client = $this->rebr->getByIdEnrollment($item->id);
                if($find_billing_client){

                    $ruc          = $find_billing_client->ruc;
                    $razon_social = $find_billing_client->razon_social;

                } else {

                    $ruc          = "";
                    $razon_social = "";

                }

                // Find in ref to person
                $person = $find_enrollment->student->persona;

                // Find Enrollment Payment
                $find_epm = $this->epmr->getByIdEnrollment($item->id);

                if($find_epm){

                    $idformaDePago = $find_epm->id_payment_method;

                    $formaDePagoName = $this->rpt->getNameById($idformaDePago);

                } else {

                    $formaDePagoName = "";
                }

                $response[] = array(
                  "creationDate"        => $find_enrollment->created_at,
                  "businessExecutive"   => $find_enrollment->created_by,
                  "fullname"            => $person['FullNameUpper'],
                  "dni"                 => $person['num_doc'],
                  "email"               => $person['correo'],
                  "cellphone"           => $person['num_cellphone'],
                  "typeDocPyament"      => "Boleta",
                  "ruc"                 => $ruc,
                  "empresa"             => $razon_social,
                  "type_specialty"      => $this->respt->getNameById($item->cod_esp_tipo),
                  "specialty"           => $this->resp->getNameById($item->cod_esp),
                  "modality"            => $this->rmod->getNameById($item->cod_modalidad),
                  "periodAcademic"      => $this->rap->getNameById($item->id_academic_period),
                  "formaDePago"         => $formaDePagoName,
                  "contacto"            => $find_enrollment->created_by,
                  "cuota1"              => "Boleta",
                  "matricula"           => "Boleta",
                  "certificado"         => "Boleta",
                  "numCoutas"           => "Boleta"
                );
            }

            return response()->json(
                [
                    "response" => $response

                ], 200 );

        }

    }

}