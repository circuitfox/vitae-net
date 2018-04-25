# Models

This document describes the purpose of the functions in the Models stored in vitae-net/app. To
learn about what Laravel Eloquent Models are and how they are used, visit
[https://laravel.com/docs/5.5/eloquent](https://laravel.com/docs/5.5/eloquent).

## Assessment Model

- `public static function byDate(Patient $patient)`: retrieves all of the
assessments for a specific patient and groups them by date in descending order. This
is used by the assessments index view to display the assessments.
- `public function patient()`: defines an inverse one-to-many relationship between Assessments
and Patients.

## Lab Model

- `public function patient()`: defines an inverse one-to-many relationship between Labs and
Patients.

## Order Model

- `public function patient()`: defines an inverse one-to-many relationship between Orders and
Patients.

## MarEntry Model

- `public function patient()`: defines an inverse one-to-many relationship between MarEntries
and Patients.
- `public function medication()`: defines an inverse one-to-many relationship between
Medications and Patients.
- `public function timesFromInteger()`: converts the given_at
integer into an array of booleans to be used when displaying MarEntries.
- `public static function timesToInteger(array $times)`: converts an array of booleans into the
given_at integer to be used when updating or creating a MarEntry.
- `public function toJsonArray()`: returns a JSON array of a MarEntry.

## Medication Model

- `public static function type_option($type)`: converts second_type values to their
representation in the edit view `<select>` element.
- `public function toApiArray()`: converts a medication's attributes into an array for use with
the /verify api route.
- `public function hasSecondary()`: returns a boolean indicating that this medication has
secondary information.
- `public function isCombo()`: returns a boolean indicating that the secondary information of
this medication is an additional medication.
- `public function isAmount()`: returns a boolean indicating that the secondary information of
this medication is an amount (e.g. units/mL).
- `public function isIn()`: returns a boolean indicating that the secondary information of this
medication is a medium that the medication is in (e.g. saline).
- `public function toString()`: returns a string representation of the medication.
- `public function primaryName()`: returns the first portion of the
medication name (i.e. the first or primary medication).
- `public function secondaryName()`: returns the second portion of the medication name, if it
exists (i.e. the secondary medication).
- `public function marEntries()`: defines a one-to-many relationship between
Medications and MarEntries.
- `public function signatures()`: defines a one-to-many relationship between
Medications and Signatures.
- `public function toMarArray()`: returns the string representation of a medication and its
medication_id to be used in the MAR.
- `public function generateBarcode()`: calls and returns the result of the
`generateBarcodeWithFormat(string $type, int $id)` function, which generates a barcode with the
medication type tag and id.
- `public function generateDownloadButton()`: calls and returns the result of the
`generateDownloadButtonWithFormat(string $type, int $id, string $fileName)` function, which
generates a download button for a barcode with the medication type tag and id.

## Patient Model

- `public function labs()`: defines a one-to-many relationship between
Patients and Labs.
- `public function orders()`: defines a one-to-many relationship between
Patients and Orders.
- `public function marEntries()`: defines a one-to-many relationship between
Patients and MarEntries.
- `public function signatures()`: defines a one-to-many relationship between
Patients and Signatures.
- `public function assessments()`: defines a one-to-many relationship between
Patients and Assessments.
- `public function toApiArray()`: converts a patient's attributes into an array for use with
the /verify api route.
- `public function generateBarcode()`: calls and returns the result of the
`generateBarcodeWithFormat(string $type, int $id)` function, which generates a barcode with the
patient type tag and id.
- `public function generateDownloadButton()`: calls and returns the result of the
`generateDownloadButtonWithFormat(string $type, int $id, string $fileName)` function, which
generates a download button for a barcode with the patient type tag and id.

## Signature Model

- `public function patient()`: defines an inverse one-to-many relationship between Signatures
and Patients.
- `public function medication()`: defines an inverse one-to-many relationship between
Signatures and Medications.

## User Model

- `public function isAdmin()`: returns a boolean indicating whether or not the user is an
admin.
- `public function isInstructor()`: returns a boolean indicating whether or not the user is an
instructor.
- `public function isPrivileged()`: returns a boolean indicating whether or not the user is either an admin or an instructor.
