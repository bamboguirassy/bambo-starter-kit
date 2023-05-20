<?php

namespace App\Custom;

use Carbon\Carbon;
use DateTime;
use Error;

class Helper
{

    public static function addDaysIgnoringWeekendsEndFerie($dateString, $duration)
    {
        if (!$dateString) {
            throw new Error("La date ne peut être vide");
        }
        if ($duration < 1) {
            throw new Error("Le nombre de jour à rajouter à la date doit être positif");
        }
        $carbonDate = Carbon::create($dateString);
        return $carbonDate->addWeekdays($duration);
    }

    public static function getFrenchFullDate($date) {
        return strftime("%A %d %B, %Y",strtotime($date));
    }
}
