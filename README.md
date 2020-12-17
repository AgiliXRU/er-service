# ER Service

Dependency breaking Kata

## Setup
* create .env from .env.example
* provide correct absolute path to erdb.sqlite file in .env

## Steps 
1. Pass null: Process 'Condition' field in /api/inboundPatients
* Find changing point // InboundPatientsProvider->currentInboundPatients()
* Try to write test
* Extract method processing xml
* Test this method, make it green
* Change test - add assert on Condition field
* Make it green

2. Expose static: Process 'Condition'
* Create previously created method static
* Change test

3. Parametrize a constructor & Extract interface: add 'RESIDENTS' to /api/physiciansOnDuty
* Find change point // StaffAssignmentProvider->getPhysiciansOnDuty()
* Try to write test
* Create factory method and replace it in clients
* Add dependencies to constructor
* Extract inter face for both dependencies (BedRepo and StaffRepo)
* Write tests
* Write needed implementation

4. Extract&Override: send a message for yellow priority and condition "heart arrhythmia" 
* Extract method with all work // scan
* Extract interface for InboundPatientsProvider // InboundPatientsSource
* Write unit test for scan // scanAlertsForPriorityRedPatients
* Subclass AlertScanner 
* Make alertForNewCriticalPatient protected and override it
* Write test on existing functionality
* Write red test for yellow priority and with condition "heart arrhythmia"
* Write needed implementation

5. Wrap: sending page for YELLOW priority without acknowledge
* create new class for PagerSystem // PagerSystemWrapper
* copy business methods // transmit transmitRequiringAcknowledgement
* copy logic to new class methods 
* extract interface // AlertTransmitter
* add property PagerSystem
* initialize it in constructor
* create setter for property
* use in tests for previous step real AlertScanner
* pass via setter test double implemented PagerSystem
* rewrite test according new requirements
* write implementation

6. Sprout method:


