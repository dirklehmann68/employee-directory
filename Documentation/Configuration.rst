
..  _configuration:

=============
Configuration
=============

This chapter describes the configuration options
available in Employee Directory.

Record storage
==============

Employee Directory uses the standard TYPO3 Extbase
record storage mechanism.

Employee records, departments, and job functions
can be stored in a dedicated TYPO3 folder.

To configure the storage location:

1. Open the page containing the Employee Directory plugin.
2. Edit the plugin content element.
3. Open the plugin's record storage settings.
4. Select the folder containing the employee records.
5. Save the content element.

Extbase uses the configured record storage page
to retrieve the corresponding records.

Plugin settings
===============

The Employee List plugin provides two configuration
tabs for controlling the information displayed
in employee cards.

Card content
------------

The following fields can be shown or hidden:

* Job function
* Department
* Phone number
* Email address
* Location
* Room
* Office hours

Images
------

The following options are available:

* Show employee images
* Show placeholder images

All nine options are enabled by default.

TypoScript
==========

Employee Directory provides configurable settings
through its TYPO3 Site Set.

The settings are organized into categories for
filters, employee cards, accessibility, templates,
styling, and page navigation.

Default settings
----------------

* CSS variant: ``standalone``
* Detail page UID: ``0``
* List page UID: ``0``
* Custom template paths: empty
* Name filter: enabled
* Job function filter: enabled
* Department filter: enabled
* Alphabetical A-Z filter: enabled

The extension also supports custom labels for
filter controls, employee card fields, and
accessibility-related text.

Custom labels are empty by default.

Styling
=======

Employee Directory supports two styling variants.

Standalone
----------

The ``standalone`` variant provides the extension's
own CSS styling without requiring Bootstrap.

This is the default setting.

Bootstrap
---------

The ``bootstrap`` variant is intended for websites
that use the Bootstrap CSS framework.

Selecting a CSS variant
-----------------------

The CSS variant can be selected in the TYPO3
site settings using the ``cssVariant`` option.

Available values:

* ``standalone`` (default)
* ``bootstrap``