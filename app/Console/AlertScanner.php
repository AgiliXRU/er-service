<?php


namespace App\Console;

class AlertScanner
{
    private $criticalPatientNotificationsSentpatient;
    const ADMIN_ON_CALL_DEVICE = "111-111-1111";
    protected $inboundProvider;
    private $pagerSystem;


    /**
     * AlertScanner constructor.
     * @param $provider
     */
    public function __construct($provider)
    {
        $this->criticalPatientNotificationsSentpatient = array();
        $this->inboundProvider = $provider;
    }

    public function setPagerSystem($pagerSystem) {
        $this->pagerSystem = $pagerSystem;
    }

    public function __invoke()
    {
        error_log("Scanning for situations requiring alerting...");
        foreach ($this->inboundProvider->getPatients() as $p) {
            error_log(" PRIORITY: " . $p->getAttribute('priority'));
            if ($p->getAttribute('priority') == 'RED') {
                error_log(" TransportId: " . $p->getAttribute('transportId'));
                if (!in_array($p->getAttribute('transportId'), $this->criticalPatientNotificationsSentpatient)) {
                    $this->alertForNewCriticalPatient($p);
                }
            }
        }
    }

    private function alertForNewCriticalPatient($patient)
    {
        try {
            $this->pagerSystem->transmitRequiringAcknowledgement(self::ADMIN_ON_CALL_DEVICE, "New inbound critical patient: " .
                $patient->getTransportId());
            array_push($this->criticalPatientNotificationsSentpatient, $patient->getAttribute('transportId'));
        } catch (\Exception $e) {
            error_log("Failed attempt to use pager system to device " . self::ADMIN_ON_CALL_DEVICE);
        }
    }
}
