## Database Diagram

This documents serves as an explanation to the entity-relationship diagram `docs/vitae-net-initial.png`. This image is a visual representation of the database tables used ~~with this system~~ initially during the merge of the scanner and orders systems.


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

The medications table is used to store a list of all the medication facsimiles available to the nursing department.

- **medication_id:** A unique identification number used to reference medications. These numbers are currently arbitrary and auto-incrementing.
- **name:** The clinical/brand name of the medication.
- **dosage_amount:** The numerical measurement of a dosage, e.g. the "12" in "12 milligrams".
- **dosage_unit:** The form of measurement used, i.e. "milligrams".
- **instructions:** The doctor's instructions for how to administer the medication.
- **comments** Additional comments on the medication made by the instructor.

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
