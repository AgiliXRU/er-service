<?php


namespace App\Providers;

use App\Models\Patient;
use SimpleXMLElement;
use function array_push;
use function count;
use function error_log;

class InboundPatientsProvider
{
    private $transportService;

    /**
     * InboundPatientsProvider constructor.
     * @param $transport
     */
    public function __construct($transport)
    {
        $this->transportService = $transport;
        $this->transportService->connect();
    }

    public function currentInboundPatients(): array
    {
        $listOfPatient = array();
        $xmlstr = $this->transportService->fetchInboundPatients();
        error_log("Received xml from transport service: $xmlstr");
        $xml = new SimpleXMLElement($xmlstr);
        foreach ($xml->Patient as $p) {
            $patient = new Patient();
            $patient->setAttribute('transportId', $p->TransportId);
            $patient->setAttribute('name', $p->Name);
            $patient->setAttribute('priority', $p->Priority);
            $patient->setAttribute('birthdate', $p->Birthdate);
            array_push($listOfPatient, $patient);
        }
        error_log("Returning inbound patients: " . count($listOfPatient));
        return $listOfPatient;
    }

}
