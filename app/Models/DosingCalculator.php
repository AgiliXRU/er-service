<?php


namespace App\Models;

class DosingCalculator
{
    public function getRecommendedSingleDose(Patient $patient, string $medication): string
    {
        $dosingSource = DosingSourceFactory::getDosingSourceFor($patient, $medication);
        error_log("classification: ".$patient->getChildClassification());
        return $dosingSource->getSingleDose($medication, $patient->getChildClassification());
    }
}
