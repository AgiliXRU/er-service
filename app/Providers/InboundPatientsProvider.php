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
    }

    public function currentInboundPatients(): array
    {
        $xmlstr = $this->transportService->fetchInboundPatients();
        error_log("Received xml from transport service: $xmlstr");
        return $this->getPatientsFromXml($xmlstr);
    }

    /**
     * @param $xmlstr
     * @return array
     */
    public static function getPatientsFromXml($xmlstr): array
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
