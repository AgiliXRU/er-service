<?php


namespace App\Models;


use DateTime;

class ChildClassification
{
    const NEONATE = 1;
    const INFANT = 2;
    const CHILD = 3;
    const ADOLESCENT = 4;
    const UNDEFINED = 5;

    public static function calculate(DateTime $birthDate, DateTime $currentDate): int
    {
        $interval = $currentDate->diff($birthDate);
        $daysOld = $interval->days;
        $yearsOld = $interval->y;

        if (($daysOld >= 0) && ($daysOld < 30)) {
            return self::NEONATE;
        }
        if (($daysOld >= 30) && ($yearsOld < 2)) {
            return self::INFANT;
        }
        if (($yearsOld >= 2) && ($yearsOld < 12)) {
            return self::CHILD;
        }
        if (($yearsOld >= 12) && ($yearsOld < 16)) {
            return self::ADOLESCENT;
        }
        if (($yearsOld >= 16)) {
            return self::UNDEFINED;
        }
        return self::UNDEFINED;
    }
}
