<?php


namespace Tests\Console;


use App\Console\AlertScanner;
use App\Providers\InboundPatientsSource;

class MockAlertScanner extends AlertScanner
{
    public $patients = array();

    protected function alertForNewCriticalPatient($patient)
    {
        array_push($this->patients, $patient);
    }


}
