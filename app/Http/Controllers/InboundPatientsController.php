<?php

namespace App\Http\Controllers;


use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class InboundPatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Game[]|\Illuminate\Http\Response
     */
    public function index()
    {
        $xmlstr = Http::get('http://ers.sergeylobin.ru/xml/inbound.xml')->body();
        error_log("xml response: $xmlstr");

        $result = $this->makeResponse($xmlstr);
        return $result;
    }

    /**
     * @param string $xmlstr
     * @return array
     */
    public static function makeResponse(string $xmlstr): array
    {
        $result = array();
        $xml = new SimpleXMLElement($xmlstr);
        foreach ($xml->Patient as $p) {
            $patient = new Patient();
            $patient->setAttribute('transportId', $p->TransportId);
            $patient->setAttribute('name', $p->Name);
            $patient->setAttribute('priority', $p->Priority);
            $patient->setAttribute('birthdate', $p->Birthdate);
            $patient->setAttribute('condition', $p->Condition);
            array_push($result, $patient);
        }
        error_log("Returning inbound patients: " . count($result));
        return $result;
    }


}
