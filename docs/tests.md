# Tests

This documentation serves to describe the functions of the tests code stored in
vitae-net/test.  This document provides an explanation for the layout of the
'test' folder.

### Sub-directories:

There are 3 sub-directories within 'test'. These directories are 'Feature',
'Javascript', and 'Unit'. Each sub-directory holds different types of tests.
Note that there are two tests that are not stored in any sub-directory but are
instead located at the top of the 'test' tree. These tests are
'CreatesApplication.php', which creates a base test application, and
'TestCase.php' which escapes special characters in faker names.

### Feature:

The 'Feature' sub-directory, the largest of the three, contains tests for each
view and database object. Within 'Feature' are another 3 sub-directories:
'Model', 'Table', and 'View'. 'Model' contains tests for the database factories
and checks to see if relationships between factories are working properly.
'Table' contains tests for each database table. 'View' contains tests for each
page the user sees. Since there are many different pages the user can land on,
'View' contains several sub-directories. Each directory corresponds to the type
of activity being done by the user and the purpose of the view. For example, the
'Medication' sub-directory contains tests for pages used for medication related
purposes, such as creating new medications, editing existing medications, and
formatting medications. 'Feature' also contains tests for the landing page,
basic page layout, admin page, summary page, signatures page, and Mar create
page.

### Javascript:

The 'Javascript' sub-directory contains only 2 tests. The tests are used for the barcode scanning process. The first is a test for the parser, which sorts the
various information the scanner receives from the barcode. The second test
merely loads the required setup information.

### Unit:

The 'Unit' sub-directory primarily contains tests for page controllers.
Additionally, 'Unit' contains a test for the reset password function should a
user forget their password.
