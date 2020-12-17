<?php


namespace App\Models;


class DosingCalculator
{
    public function getRecommendedSingleDose(Patient $patient, string $medication): string
    {
        $dosingSource = DosingSourceFactory::getDosingSourceFor($patient, $medication);
        return $dosingSource->getSingleDose($medication, $patient->getChildClassification());
    }
}
