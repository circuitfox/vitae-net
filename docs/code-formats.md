## Code formats

This document describes how medication and patient data should be formatted before being entered into a 2D or 1D barcode generator for encoding.

The pertinent data that describes a medication or patient is formatted into a string of semicolon separated values, i.e.- semicolons appear between values, not after (ergo the final value in the string does not have a semicolon after it).

Recommended QR code generator: https://forqrcode.com/ set to size 4 and encoding precision L.

### Null values

Sometimes the description of a certain medication or patient has less pertinent data than other medications/patients. The data missing from these descriptions are referred to as null values. Null values should be represented as a lack of space or any other characters between semicolons, e.g.- ";;".

---


## Medications

8 fields of semicolon separated values (7 semicolons):
- primary_name;primary_dosage_amount;primary_dosage_unit;secondary_name;second_amount;second_unit;second_type;comments

#### Examples
| Medication Description | Formatted Data |
|------------------------|----------------|
| Albuterol MDI | Albuterol MDI;;;;;;; |
| Acetaminophen 325 milligrams | Acetaminophen;325;milligrams;;;;; |
| Hydrocodone Bitartate 5 milligrams/Acetaminophen 325 milligrams | Hydrocodone Bitartate;5;milligrams;Acetaminophen;325;milligrams;combo; |
- Note: The comments value on each of these is blank.


## Patients

12 fields of semicolon separated values (11 semicolons):
- medical_record_number;last_name;first_name;date_of_birth;sex;height;weight;diagnosis;code_status;physician;room

#### Examples

| Patient Description | Formatted Data |
|---------------------|----------------|
| Name: Garcia, Maria DOB: 1/26/19XX Allergies: none Gender: Female MRN: 605065 Room: 302 Physician: Dr. Andrews Diagnosis: Flu Height: 5'3" Weight: 130lbs Code Staus: regular | 605065;Garcia;Maria;1/26/19XX;Female;5'3";130lbs;Flu;none;regular;Dr. Andrews;302 |
| Name: Smith, George DOB: 1.1.1938 Gender: Male MRN: 605066 | 605066;Smith;George;1.1.1938;Male;;;;;;; |
