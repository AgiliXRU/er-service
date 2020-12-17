<?php


namespace App\Console;

use App\Providers\InboundPatientsProvider;


class AlertScanner
{
    private $criticalPatientNotificationsSentpatient;
    const ADMIN_ON_CALL_DEVICE = "111-111-1111";
    protected $inboundProvider;

    /**
     * AlertScanner constructor.
     * @param $provider
     */
    public function __construct(InboundPatientsProvider $provider)
    {
        $this->criticalPatientNotificationsSentpatient = array();
        $this->inboundProvider = $provider;
    }

    public function __invoke()
    {
        error_log("Scanning for situations requiring alerting...");
        foreach ($this->inboundProvider->currentInboundPatients() as $p) {
            error_log(" PRIORITY: " . $p->getAttribute('priority'));
            if ($p->getAttribute('priority') == 'RED') {
                error_log(" TransportId: " . $p->getAttribute('transportId'));
                if (!in_array($p->getAttribute('transportId'), $this->criticalPatientNotificationsSentpatient)) {
                    $this->alertForNewCriticalPatient($p);
                }
            }
        }
    }

    protected function alertForNewCriticalPatient($patient)
    {
        try {
            $transport = PagerSystem::getTransport();
            $transport->initialize();
            $transport->transmitRequiringAcknowledgement(self::ADMIN_ON_CALL_DEVICE, "New inbound critical patient: " .
                $patient->getTransportId());
            array_push($this->criticalPatientNotificationsSentpatient, $patient->getAttribute('transportId'));
        } catch (\Exception $e) {
            error_log("Failed attempt to use pager system to device " . self::ADMIN_ON_CALL_DEVICE);
        }
    }
}
