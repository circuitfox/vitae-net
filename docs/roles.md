## User Roles

There are three user roles: admin, instructor, and student.

* admin — Has complete access to all parts of the application. Its only
  restriction is that it cannot update other users' account information. There
  is only one admin, which is created during database setup.
* instructor — The instructor is allowed to manage the models of the application.
  It can create, update, view, and delete medication, patients, orders, and
  labs, and has access to an administration page to allow it to perform these
  tasks.
* student — The student can view the models of the application, and may mark
  orders as completed. They have access to a homepage that allows them to
  view models and incomplete orders. They are also able to scan patients and
  medications with the barcode scanner.

There is also a fourth role: the unauthenticated user.

* unauthenticated — An unauthenticated user may only scan patients and
  medications with the barcode scanner and has no other access to the
  application.

These roles can be read as a hierarchy, with each role up the hierarchy gaining
new abilities in addition to the ones granted to the previous role. The
hierarchy goes, from least authorized to most authorized: unauthenticated,
student, instructor, admin.

Roles are set when a user is created, and cannot be changed. Changing a user's
role means first deleting their account and creating a new account with the
desired role.
