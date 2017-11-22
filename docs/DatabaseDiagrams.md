## Database Diagrams

This documents serves as an explanation to the entity-relationship data model diagrams Phase1ERD.png and Phase2ERD.png. These images represent the basic form of the database tables to be used with this system. Statements made regarding tables in Phase 1 hold true for Phase 2 unless stated otherwise.


### Notes:

- Table names are presented as bold plural nouns in lowercase at the top of each table. Below the name is a series of rows identifying the attributes used by the table.
- The first column contains index constraints. PK = primary key. FK = foreign key. N = nullable.
- The second column contains the names of attributes stored in the table. The naming convention here is snake_case.
- The third column describes the data-type of the attribute.


---


### Phase 1 ERD

**users:** The users table is used for sign-in authentication.
- The role attribute will have a value of "admin" for system administrators. Other possible values may be devised. This attribute may be altered or completely removed if it is deemed unnecessary.

**medications:** The medications table is used to store a list of all the medication facsimiles available to the nursing department.
- The medication_id attribute corresponds to the serial identification of a particular medication, such as a UPC, EAN or other product identification code. The value of this is arbitrarily assigned by the system when new medications are added to the list.
- The dosage_amount attribute corresponds to the numerical measurement of a dose, e.g. the "12" in "12 milligrams".
- The dosage_unit attribute indicates the form of measurement used, such as "milligrams".
- The stat attribute represents whether or not the medication is a stat/prn medication. The value "0"/"FALSE" will indicate the medication is not stat/prn, while "1"/"TRUE" will indicate that the medication is stat/prn.

**patients:** The patients table is used to store information relevant to the virtual patients who may be listed on a medical administration record for the students to interact with.
- The sex attribute indicates the biological gender of the patient. The value "0"/"FALSE" will indicate the patient is female, while "1"/"TRUE" will indicate the patient is male.


### Phase 2 ERD

**medications:** The medications table is used to store a list of all the medication facsimiles available to the nursing department.
- The medication_id attribute corresponds to the serial identification of a particular medication, such as a UPC, EAN or other product identification code. The value of this is obtained by scanning the medication's barcode.

**med_admin_record:** This table will allow for users to create and store medical administration records (MAR) that can be viewed by students.
- A MAR can only have one patient, but it may have many different medications.

**meds_given:** This table is an associative entity linking the medications and med_admin_record tables.
- The time_given attribute represents the time of day the medication is to be given to the patient, as prescribed.
