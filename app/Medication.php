<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    public const SECOND_TYPES = ['combo', 'amount', 'in'];

    private const NAME_SEPARATOR = '|';

    protected $primaryKey = 'medication_id';

    protected $fillable = [
      'name', 'dosage_amount', 'dosage_unit',
      'second_amount', 'second_unit', 'second_type',
      'comments',
    ];

    public function toApiArrayV1() {
        return [
            'name' => $this->primaryName(),
            'dosage_amount' => $this->dosage_amount,
            'dosage_unit' => $this->dosage_unit,
            'comments' => $this->comments,
        ];
    }

    public function toApiArrayV2() {
        return [
            'name' => $this->primaryName(),
            'secondary_name' => $this->secondaryName(),
            'dosage_amount' => $this->dosage_amount,
            'dosage_unit' => $this->dosage_unit,
            'second_amount' => $this->second_amount,
            'second_unit' => $this->second_unit,
            'second_type' => $this->second_type,
            'comments' => $this->comments,
        ];
    }

    public function primaryName() {
        return explode($this::NAME_SEPARATOR, $this->name)[0];
    }

    public function secondaryName() {
        $names = explode($this::NAME_SEPARATOR, $this->name);
        if (array_key_exists(1, $names)) {
            return $names[1];
        } else {
            return '';
        }
    }
}
