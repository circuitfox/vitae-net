## Database Diagrams

This documents serves as an explanation to the entity-relationship data model diagrams Phase1ERD.png and Phase2ERD.png. These images represent the basic form of the database tables to be used with this system.


### Notes:

- Table names are presented as bold plural nouns in lowercase at the top of each table. Below the name is a series of rows identifying the attributes used by the table.
- The first column contains index constraints. PK = primary key. FK = foreign key. N = nullable.
- The second column contains the names of attributes stored in the table. Naming convention here is snake_case.
- The third column describes the data-type of the attribute.


---


### Phase 1 ERD

**users:** The users table is used for sign-in authentication. The role attribute will have a value of "admin" for system administrators. Other possible values may eventually be devised. This attribute may also be completely removed if it is deemed unnecessary.

**medications:** The medications table is used to store a list of all the medication facsimiles available to the nursing department. The medication_id attribute corresponds to the serial identification of a particular medication, such as a UPC. The dosage_amount attribute corresponds to the numerical measurement of a dose, e.g. the "12" in "12 milligrams". The dosage_unit attribute indicates the form of measurement used, such as "milligrams". The stat attribute represents whether or not the medication is a stat/prn medication.

**patients:** The patients table is used to store information relevant to the virtual patients who may be listed on a medical administration record for the students to interact with.


### Phase 2 ERD

**med_admin_record:** This table will allow for users to create and store medical administration records that can be viewed by students. A MAR can only have one patient, but it may have many different medications.

**meds_given:** This table is an associative entity linking the medications and med_admin_record tables. It also contains the time_given attribute, which indicates the time of day that the medication is supposed to be given to the patient.
