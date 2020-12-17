<?php


namespace App\Models;

use RuntimeException;

class ChildDosingDatabase
{

    private $dosingMap = array(
        "Tylenol Oral Suspension" . ChildClassification::NEONATE => "0",
        "Tylenol Oral Suspension" . ChildClassification::INFANT => "2.5 ml",
        "Tylenol Oral Suspension" . ChildClassification::CHILD => "5 ml",
        "Tylenol Oral Suspension" . ChildClassification::ADOLESCENT => "15 ml",
        "Amoxicillin Oral Suspension" . ChildClassification::NEONATE => "15 mg/kg",
        "Amoxicillin Oral Suspension" . ChildClassification::INFANT => "50 mg/kg",
        "Amoxicillin Oral Suspension" . ChildClassification::CHILD => "80 mg/kg",
        "Amoxicillin Oral Suspension" . ChildClassification::ADOLESCENT => "120 mg/kg"
    );


    public function getSingleDose(string $medication, int $childClassification): string
    {
        if (ChildClassification::UNDEFINED == $childClassification) {
            throw new RuntimeException("Disallowed dosing lookup for " . $medication . ", " . $childClassification);
        }
        return $this->dosingMap[$medication . $childClassification];
    }
}
