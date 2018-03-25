<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'medical_record_number');
    }

    /**
     * Retrieves all assessments for a given patient, grouped by their date in
     * descending order.
     * The array is a Laravel collection and can be manipulated using Laravel's
     * collections methods.
     */
    public static function byDate(Patient $patient)
    {
        return self::where('medical_record_number', $patient->medical_record_number)
            ->get()
            ->mapToGroups(function ($assessment) {
                $assessment = $assessment->toArray();
                $date = $assessment['date'];
                return [$date => $assessment];
            })->sortByDesc(function ($assessment, $date) {
                return $date;
            });
    }
}
