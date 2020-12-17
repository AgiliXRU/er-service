<?php

namespace Tests\Providers;

use App\Providers\InboundPatientsProvider;
use PHPUnit\Framework\TestCase;

class InboundPatientsProviderTest extends TestCase
{

    public function testCurrentInboundPatients()
    {
//        $inboundPatientsProvider = new InboundPatientsProvider(null);

        $xml = "<Inbound>
<Patient>
<TransportId>1</TransportId>
<Name>John Doe</Name>
<Condition>heart aritmya</Condition>
<Priority>YELLOW</Priority>
<Birthdate/>
</Patient>
</Inbound>";

        $patients = InboundPatientsProvider::getPatientsFromXml($xml);

        $this->assertNotNull($patients);
        $this->assertCount(1, $patients);
        $this->assertEquals("John Doe", $patients[0]->getAttribute('name'));
        $this->assertEquals("heart aritmya", $patients[0]->getAttribute('condition'));
    }
}
