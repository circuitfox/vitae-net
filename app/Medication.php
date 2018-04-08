<?php

namespace App;

use App\GeneratesBarcodes;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use GeneratesBarcodes;

    const SECOND_TYPES = ['combo', 'amount', 'in'];

    /**
     * Helper function for converting second_type values
     * to their representation in the edit view <select>
     * element.
     *
     * @param string $type The second_type value
     * @return string
     */
    public static function type_option($type)
    {
        switch ($type) {
          case 'combo':
              return 'and';
          case 'amount':
              return 'with';
          case 'in':
              return 'in';
          default:
              return '';
        }
    }

    const NAME_SEPARATOR = '|';

    protected $primaryKey = 'medication_id';

    protected $fillable = [
      'name', 'dosage_amount', 'dosage_unit',
      'second_amount', 'second_unit', 'second_type',
      'comments',
    ];

    /**
     * Converts this medication's attributes into an array for use with the
     * /verify api route.
     *
     * @return array
     */
    public function toApiArray()
    {
        return [
            'medication_id' => $this->medication_id,
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

    /**
     * Returns a boolean indicating that this medication has secondary information.
     *
     * @return bool
     */
    public function hasSecondary()
    {
        return !(is_null($this->second_amount) && is_null($this->second_unit));
    }

    /**
     * Returns a boolean indicating that the secondary information of this
     * medicaton is an additional medication.
     *
     * @return bool
     */
    public function isCombo()
    {
        return $this->hasSecondary() && $this->second_type === 'combo';
    }

    /**
     * Returns a boolean indicating that the secondary information of this
     * medicaton is an amount (e.g. units/mL).
     *
     * @return bool
     */
    public function isAmount()
    {
        return $this->hasSecondary() && $this->second_type === 'amount';
    }

    /**
     * Returns a boolean indicating that the secondary information of this
     * medicaton is a medium that the medication is in (e.g. saline).
     *
     * @return bool
     */
    public function isIn()
    {
        return $this->hasSecondary() && $this->second_type === 'in';
    }

    /**
     * Returns a string representation of this medication.
     *
     * @return string
     */
    public function toString()
    {
        if ($this->second_type === 'combo') {
            return $this->primaryName()
                . " {$this->dosage_amount} {$this->dosage_unit} / "
                . $this->secondaryName()
                . " {$this->second_amount} {$this->second_unit}";
        } elseif ($this->second_type === 'amount') {
            return $this->primaryName()
                . " {$this->dosage_amount} {$this->dosage_unit} with "
                . "{$this->second_amount} {$this->second_unit}";
        } elseif ($this->second_type === 'in') {
            return $this->primaryName()
                . " {$this->dosage_amount} {$this->dosage_unit} in "
                . $this->secondaryName()
                . " {$this->second_amount} {$this->second_unit}";
        } else {
            return $this->primaryName()
                . " {$this->dosage_amount} {$this->dosage_unit}";
        }
    }

    public function primaryName()
    {
        return explode($this::NAME_SEPARATOR, $this->name)[0];
    }

    public function secondaryName()
    {
        $names = explode($this::NAME_SEPARATOR, $this->name);
        if (array_key_exists(1, $names)) {
            return $names[1];
        } else {
            return '';
        }
    }

    public function marEntries()
    {
        return $this->hasMany('\App\MarEntry', 'medication_id');
    }

    public function signatures()
    {
        return $this->hasMany('\App\Signature', 'medication_id');
    }

    public function toMarArray()
    {
        return [
            'name' => $this->toString(),
            'id' => $this->medication_id,
        ];
    }

    public function generateBarcode()
    {
        return $this->generateBarcodeWithFormat('m', $this->medication_id);
    }

    public function generateDownloadButton()
    {
        if ($this->secondaryName() !== '') {
            $name = $this->primaryName() . '-' . $this->secondaryName() . '.png';
        } else {
            $name = $this->primaryName() . '.png';
        }
        return $this->generateDownloadButtonWithFormat(
            'm',
            $this->medication_id,
            $name
        );
    }
}
