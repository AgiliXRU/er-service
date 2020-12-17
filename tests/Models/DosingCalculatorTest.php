<?php

namespace Tests\Models;

use App\Models\DosingCalculator;
use App\Models\Patient;
use DateInterval;
use DateTime;
use RuntimeException;
use PHPUnit\Framework\TestCase;

class DosingCalculatorTest extends TestCase
{

    private $patient;
    private $dosingCalculator;

    protected function setUp(): void
    {
        $this->patient = new Patient();
        $this->dosingCalculator = new DosingCalculator();
    }

    public function testReturnsCorrectDosesForNeonate()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P1M')));

        $singleDose = $this->dosingCalculator->getRecommendedSingleDose($this->patient, "Tylenol Oral Suspension");

        $this->assertEquals("0", $singleDose);
    }

    public function testReturnsCorrectDosesForInfant()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P40D')));

        $singleDose = $this->dosingCalculator->getRecommendedSingleDose($this->patient, "Tylenol Oral Suspension");

        $this->assertEquals("2.5 ml", $singleDose);
    }

    public function testReturnsCorrectDosesForChild()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P3Y')));

        $singleDose = $this->dosingCalculator->getRecommendedSingleDose($this->patient, "Tylenol Oral Suspension");

        $this->assertEquals("5 ml", $singleDose);
    }

    public function testReturnsCorrectDosesForNeonateAmox()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P20D')));

        $singleDose = $this->dosingCalculator->getRecommendedSingleDose($this->patient, "Amoxicillin Oral Suspension");

        $this->assertEquals("15 mg/kg", $singleDose);
    }

    public function testReturnsExceptionForAdults()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P16Y')));

        $this->expectException(RuntimeException::class);

        $this->dosingCalculator->getRecommendedSingleDose($this->patient, "Amoxicillin Oral Suspension");
    }

    public function testReturnsNullForUnrecognizedMedication()
    {
        $date = new DateTime('NOW');
        $this->patient->setAttribute('birthDate', $date->sub(new DateInterval('P16Y')));

        $this->expectException(RuntimeException::class);

        $this->dosingCalculator->getRecommendedSingleDose($this->patient, "No Such Med");
    }

}
