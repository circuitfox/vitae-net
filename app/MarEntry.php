<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarEntry extends Model
{
    protected $table = 'mar_entries';
    public $timestamps = false;
    protected $fillable = [
      'medical_record_number', 'medication_id', 'stat',
       'instructions', 'given_at',
    ];

    // given_at
    //
    // +------+------+------+------+------+------+------+------+------+------+------+------+------+
    // | 0700 | 0800 | 0900 | 1000 | 1100 | 1200 | 1300 | 1400 | 1500 | 1600 | 1700 | 1800 | 1900 |
    // +------+------+------+------+------+------+------+------+------+------+------+------+------+
    // 0      1      2      3      4      5      6      7      8      9     10     11     12     13
    //
    public const TIMES = [
        0x1, // 0700
        0x2, // 0800
        0x4, // 0900
        0x8, // 1000
        0x10, // 1100
        0x20, // 1200
        0x40, // 1300
        0x80, // 1400
        0x100, // 1500
        0x200, // 1600
        0x400, // 1700
        0x800, // 1800
        0x1000, // 1900
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'medical_record_number');
    }

    public function medication()
    {
        return $this->belongsTo('App\Medication', 'medication_id');
    }

    /**
     * Converts the given_at integer into an array of booleans
     *
     * @return array
     */
    public function timesFromInteger()
    {
        $times = [];
        foreach (self::TIMES as $idx => $time) {
            // we need to shift right to normalize our values to one, so that
            // if e.g. '1200' is set, we get 1 and not 32
            $times[$idx] = ($this->given_at & $time) >> $idx;
        }
        return $times;
    }

    /**
     * Converts an array of booleans (integers 1 or 0) into an integer for use
     * in the given_at field/
     *
     * @param array $times boolean array of set times
     * @return integer
     */
    public static function timesToInteger(array $times)
    {
        $given_at = 0;
        if (!empty($times)) {
            foreach ($times as $idx => $time) {
                // we shift left to convert a 1 to the proper value for the given
                // bit, so that e.g. if '1200' is set we or with 32 and not 1.
                $given_at |= self::TIMES[$idx] & ($time << $idx);
            }
        }
        return $given_at;
    }
}
