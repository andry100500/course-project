<?php


namespace App\Services;

use App\Models\Currencies;
use Illuminate\Support\Facades\Cache;

class CourseManager
{
    private $source = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    public function getCourse($courseCode)
    {
        if ($courseCode == 'UAH') return 1;
        if (Cache::has('courses')) {
            return Cache::get('courses')[$courseCode];
        } else {

            $courses = $this->rebuildCoursesArray(json_decode(file_get_contents($this->source)));
            Cache::put('courses', $courses, now()->addMinutes(10));
            return $courses[$courseCode];
        }
    }


    public function rebuildCoursesArray($courses)
    {
        $newCoursesArray = [];

        foreach ($courses as $course) {
            $newCoursesArray[$course->ccy] = $course->sale;
        }

        return $newCoursesArray;

    }


}
