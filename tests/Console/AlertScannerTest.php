<?php

namespace Tests\Console;

use App\Console\AlertScanner;
use App\Models\Patient;
use App\Providers\InboundPatientsProvider;
use PHPUnit\Framework\TestCase;

class AlertScannerTest extends TestCase
{

    public function testShouldSendMessageAboutPatientsWithRedPriority()
    {
        $john = new Patient();
        $john->setAttribute('priority', 'RED');
        $john->setAttribute('transportId', 11);

        $peter = new Patient();
        $peter->setAttribute('priority', 'YELLOW');
        $peter->setAttribute('condition', 'mild stroke');
        $peter->setAttribute('transportId', 12);
        $patients = array($john, $peter);
        $scanner = new MockAlertScanner(new StubInboundPatientsProvider($patients));

        $scanner->scanPatients();

        $this->assertCount(1, $scanner->patients);
        $this->assertEquals(11, $scanner->patients[0]->getAttribute('transportId'));
    }

    public function testShouldSendMessageAboutPatientsWithRedPriorityAndYellowHeartAritmia()
    {
        $john = new Patient();
        $john->setAttribute('priority', 'RED');
        $john->setAttribute('transportId', 11);

        $peter = new Patient();
        $peter->setAttribute('priority', 'YELLOW');
        $peter->setAttribute('condition', 'heart aritmya');
        $peter->setAttribute('transportId', 12);
        $patients = array($john, $peter);
        $scanner = new MockAlertScanner(new StubInboundPatientsProvider($patients));

        $scanner->scanPatients();

        $this->assertCount(2, $scanner->patients);
        $this->assertEquals(11, $scanner->patients[0]->getAttribute('transportId'));
        $this->assertEquals(12, $scanner->patients[1]->getAttribute('transportId'));
    }
}
