<?php


namespace App\Models;


use RuntimeException;

class DosingSourceFactory
{

    public static function getDosingSourceFor(Patient $patient, string $medication)
    {
        if (ChildClassification::UNDEFINED != $patient->getChildClassification()) {
            return new ChildDosingDatabase();
        }
        throw new RuntimeException("Dosing Calculator to use for patient and medication undefined");

    }
}
