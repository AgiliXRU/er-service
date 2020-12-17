# ER Service

Dependency breaking Kata

## Setup
* create .env from .env.example
* provide correct absolute path to erdb.sqlite file in .env

## Steps
1. Process 'Condition' field in http://localhost:8000/api/inboundPatients
* Find changing point // InboundPatientsProvider->currentInboundPatients()
* Try to write test
* 
