
..  _plugins:

=======
Plugins
=======

Employee Directory provides three plugin configurations
for displaying employee profiles.

Combined list and detail view
=============================

Plugin name: ``EmployeeList``

This plugin provides the employee list, filtering,
and individual employee detail views.

It supports the ``list``, ``show``, and ``filter``
controller actions.

Standalone employee list
========================

Plugin name: ``EmployeeListOnly``

This plugin displays the employee list with its
search and filtering functions.

It supports the ``list`` and ``filter`` controller
actions.

Standalone employee detail view
===============================

Plugin name: ``EmployeeDetail``

This plugin displays an individual employee profile.

It supports the ``show`` controller action.

Linking the employee list to a detail page
==========================================

The combined ``EmployeeList`` plugin displays employee
details on the same page.

When using the standalone ``EmployeeListOnly`` plugin,
a separate page containing the ``EmployeeDetail``
plugin is required for detail views.

Configure the ``detailPageUid`` site setting with
the UID of that detail page.

If ``detailPageUid`` is ``0``, the standalone list
does not display links to employee details.

The detail link is only displayed when an employee
has a description.

Linking the detail page back to the list
========================================

The combined ``EmployeeList`` plugin provides a
back button that returns to the employee list
on the same page.

When using the standalone ``EmployeeDetail`` plugin,
configure the ``listPageUid`` site setting with
the UID of the page containing the
``EmployeeListOnly`` plugin.

The back button then links to that list page.

If ``listPageUid`` is ``0``, the standalone detail
view does not display a back button.


