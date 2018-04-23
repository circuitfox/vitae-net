#Views

This documentation serves to describe the functions of the views stored in
vitae-net/resources/views.  This document provides an explanation for the layout 
of the 'views' folder.

Sub-directories:

The 'views' folder contains 4 sub-directories; 'admin', 'auth', 'layouts', and
'partials'. Additionally, at the top of the file tree in 'views', there are
5 php files. One is the administrator view, one serves to change the time in
the summary page to 24-hours, and the remaining 3 are basic panel headings.

admin:

The 'admin' sub-directory contains the primary views for every page in vitae-net
These views are stored at the top of the file tree in 'admin'. Additionally,
there are several sub-directories to organize the edit and create views. These
sub-directories are organized by type of view. For instance, the 'medication'
sub-directory contains the edit view for medications. Likewise the 'medications'
sub-directory contains the create view for medications.

auth:

The 'auth' sub-directory contains the user account related views. This includes
the views for the log-in and register pages, which are stored at the top of the
file tree in 'auth'. Additionally, there is a 'passwords' sub-directory
containing the password reset view for first time users, as well as a similar
reset view for users who have forgotten their password.

layouts:

The 'layouts' sub-directory is simple, containing only the headers for all other
layout files.

partials:

The 'partials' sub-directory contains all page partials that are used in each
of the views in vitae-net. These partials are referenced in the views stored at
the top of the file tree in the 'admin' sub-directory. These partials are
organized into sub-directories based on which view they serve. For instance,
the 'lab' sub-directory contains all the partials for lab related views.
The sub-directories in 'partials' generally contain one or more of the following
files: a basic "body" file, delete-modal, complete-modal, and a header file.
The one exception is the 'nav' sub-directory. The partials here are different
as they serve to structure the navigation bar at the top of the screen in
vitae-net.
