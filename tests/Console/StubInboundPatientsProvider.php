<?php


namespace Tests\Console;


use App\Providers\InboundPatientsSource;

class StubInboundPatientsProvider implements InboundPatientsSource
{

    public $patients;

    /**
     * MockInboundPatientsProvider constructor.
     */
    public function __construct($patients)
    {
        $this->patients = $patients;
    }

    public function getPatients(): array
    {
        return $this->patients;
    }
}
