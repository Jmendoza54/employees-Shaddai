<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Carbon\Carbon;

class MyHelpers{

    public static function formatDateEmployee($date){
        $year = Str::substr($date, 0, 4);
        $month = Str::substr($date, 5, 2);
        $day = Str::substr($date, 8, 2);
        $newDate = Carbon::createFromDate($year, $month, $day)->isoFormat('DD/MMM/G');

        return $newDate;
    }  
}