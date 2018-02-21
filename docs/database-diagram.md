## Database Diagram

This documents serves as an explanation to the entity-relationship diagram `docs/vitae-net-ERD.png`. This image is a visual representation of the database tables used with this system.


#### Notes:

- Table names are presented as bold plural nouns in lowercase at the top of each table. Below the name is a series of rows identifying the attributes used by the table.
- The first column contains important properties of the attributes, such as keys and constraints: PK = primary key; FK = foreign key; N = nullable value; U = unique value.
- The second column contains the names of attributes stored in the table. The naming convention here is snake_case.
- The third column is the data type of the attribute as defined by the Laravel framework.
- The 'rememberToken' and 'timestamps' attributes are php method calls unique to Laravel.


---


### users

The users table is used for user sign-in and authentication.

- **id:** A unique identification number used to reference users.
- **name:** The user's name.
- **email:** The email address of the user.
- **password:** The password created by the user is encrypted by Laravel before being stored as a string of characters.
- **role:** This represents the user's responsibilities and privilege level within the system through the use of the web application. Instructors, identified by the value "instructor", will be able to manage medications, patient data, orders, and labs stored in the database. The chief system administrator, identified by the value "admin", will have the ability to create new user accounts in addition to being able to perform all functions an instructor can. Students and all others employed to administer or maintain the system will be referred to as "subadmin" and will have the same privileges as instructors.
- **reset_password:** This has a default value of 1, which allows the system to automatically ask a new user to create a new password the first time they log in.

### password_resets

This table is automatically created by Laravel and is used for emailing password reset links to users.

### orders

The orders table is used to store the doctor's orders that will be electronically delivered to students during exercises with the SimMan.

- **id:** A unique identification number used to reference orders.
- **name:** The name of the particular orders document.
- **description:** A description of the orders document.
- **file_path:** The location of an associated PDF document or image file.
- **patient_id:** This refers to the patient that the order is for and is tied to the medical_record_number of a patient stored in the patients table.
- **completed:** This indicates whether or not the students have completed following the orders.

### medications

The medications table is used to store a list of all the facsimile medication dosages available to the nursing department.

- **medication_id:** A unique identification number used to reference medications. These numbers are currently arbitrary and auto-incrementing.
- **name:** The clinical/brand name of the medication. When a single medication contains two names, separate them with a pipe character, e.g.- "Ancef|normal insulin".
- **dosage_amount:** The numerical measurement of a dosage, e.g. the "12" in "12 milligrams".
- **dosage_unit:** The form of measurement used, i.e. "milligrams".
- **second_amount:** Dosage amount for use when a medication dosage contains a second numerical value.
- **second_unit:** Dosage unit for use when a medication dosage contains a second type of measurement.
- **second_type:** This denotes the relation second_amount and second_unit have to the medication dosage. Accepted values are "combo" (as in the medication is a combination, e.g.- 'Tylenol #3 Acetaminophen/Codeine 300mg/30mg'), "amount" (as in the total amount the liquid/gel/cream container holds, e.g.- 'Regular insulin 100 units/mL 10mL vial'), and "in" (as in the first part of the medication is in the second part, e.g.- "Ancef 1g in 50mL normal saline").
- **comments** Additional comments on the medication made by the instructor.

  Formatted examples:

| name | dosage_amount | dosage_unit | second_amount | second_unit | second_type | comments |
|------|---------------|-------------|---------------|-------------|-------------|----------|
| Lasix | 20 | mg | null | null | null | null |
| Tylenol #3 Acetaminophen\|Codeine | 300 | mg | 30 | mg | combo | Do not confuse with Tylenol #2. |
| Regular insulin | 100 | units/mL | 10 | mL | amount | Dispose only in hazard waste bin. |
| Ancef\|normal saline | 1 | g | 50 | mL | in | Shake before use. |

### labs

The labs table is used to store patient lab results that will be electronically delivered to students during exercises with the SimMan.

- **id:** A unique identification number used to reference labs.
- **name:** The name of the particular labs document.
- **description:** A description of the labs document.
- **file_path:** The location of an associated PDF document or image file.
- **patient_id:** This refers to the patient that the lab result is for and is tied to the medical_record_number of a patient stored in the patients table.

### patients

The patients table is used to store information relevant to the virtual patients the students will interact with.

- **medical_record_number:** A unique identification number used to reference patients. This number is created by the instructors and can be found on patient wristbands and other documents.
- **last_name:** The surname of the patient.
- **first_name:** The given name of the patient.
- **date_of_birth:** The patient's date of birth.
- **sex:** This indicates the sex of the patient. The value "0" will indicate the patient is female, while "1" will indicate the patient is male.
- **height:** The height of the patient in whatever units the instructor chooses.
- **weight:** The weight of the patient in whatever units the instructor chooses.
- **diagnosis:** The medical diagnosis of the patient.
- **allergies:** Any allergies the patient may have.
- **code_status:** Instructions on what the student should do when the patient "codes" (goes into cardiac/respiratory arrest).
- **physician:** The patient's doctor.
- **room:** The room that the patient can be found in.

### mar_entries

The mar_entries table is used to store prescriptions for patients. These records are used to populate medical administration records ("MAR"). The foreign keys `medication_id` and `medical_record_number` form a composite key.

- **medication_id:** This is a foreign key referencing the `medication_id` field from the `medications` table.
- **medical_record_number:** This is a foreign key referencing the `medical_record_number` field from the `patients` table.
- **stat:** This indicates whether the medication is stat/PRN ("pro re nata"), or "as needed." An as needed medication is any medication that is prescribed to a patient for a short period of time in response to a diagnosis. The value "0" will indicate the medication is not PRN, while "1" will indicate the medication is PRN.
- **instructions:** This contains any additional instructions from the doctor for administering the medication.
- **given_at:** The bits of this integer represent 13 boolean values. Each bit, from right to left, represents an hour of the day from 0700 to 1900. The value "1" indicates the value is to be given at this hour.

### signatures

The signatures table is used to show which student administered what prescription at which time. The foreign keys `medication_id` and `medical_record_number` form a composite key.

- **medication_id:** This is a foreign key referencing the `medication_id` field from the `medications` table.
- **medical_record_number:** This is a foreign key referencing the `medical_record_number` field from the `patients` table.
- **time:** This is the time of day that the student administered the medication.
- **student_name:** The name of the student that administered the medication. This serves as his/her signature.
