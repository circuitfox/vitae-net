<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $primaryKey = 'medication_id';

    protected $fillable = [
      'name', 'dosage_amount', 'dosage_unit',
      'instructions', 'comments',
    ];

    public function toApiArray() {
        return [
            'name' => $this->name,
            'dosage' => $this->dosage_amount,
            'units' => $this->dosage_unit,
            'instructions' => $this->instructions,
            'comments' => $this->comments,
        ];
    }
}
