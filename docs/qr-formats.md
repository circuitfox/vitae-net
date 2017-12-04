## Patients

QR codes for patients have (from the example documents) one of the following
formats, as they will appear when scanned:

```
<first_name> <last_name>DOB: <dob>MRN: <mrn>
<first_name> <last_name><dob>
<first_name> <last_name><dob>MRN:<mrn>
```

Where:

```
dob = mm/dd/yyyy | mm.dd.yyyy | mm.dd.yyXX
mrn = 6 digit code
```

This means that, for verification purposes, only the name and date of birth of
the patient can be trusted to exist. The MRN is nice to have for verification,
but cannot be relied on. When creating patients, this also means that the MRN
field may need to be filled in separately.

## Medications

QR codes for medications have (from the sample documents) one of the following
formats:

```
(1) <dosasge> <units> <name>
(2) <dosage><units> <name>
(3) <dosage><units>/<dosage><units> <name>
(4) <dosage><units> / <dosage> <units> <name>
(5) <name>
(6) <dosage> <units> <name> <dosage> <units>
(7) <name> <dosage> <units>/<dosage> <units>
(8) <name> <dosage> <units>
(9) <name> <dosage> <units> in <dosage> <units> <name>
```

Where:

```
name   = the name of a medication or substrate, can include percentage
         e.g. 0.9% Sodium Chloride, distilled water
dosage = the amount of a medication or substance. Always a number, can be
         decimal
units  = the units a quantity is in e.g. mg, mL, units/mL.
         May contain any practically any kind of character.
```

Currently, only the first dosage is actually used, the rest is appended onto
the units field.
