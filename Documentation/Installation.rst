
..  _installation:

============
Installation
============

Employee Directory can be installed using Composer
or the TYPO3 Extension Repository (TER).

Installation via Composer
=========================

For Composer-based TYPO3 installations, run:

..  code-block:: bash

    composer require dirk-lehmann/employee-directory:^1.0

Installation via TYPO3 Extension Manager
========================================

For non-Composer TYPO3 installations:

1. Open the TYPO3 backend.
2. Navigate to the Extension Manager.
3. Search for ``employee_directory``.
4. Install the extension.

Activate the Site Set
=====================

Employee Directory provides a TYPO3 Site Set named
``dirk-lehmann/employee-directory``.

To activate it:

1. Open the TYPO3 backend.
2. Navigate to :guilabel:`Site Management > Sites`.
3. Edit the configuration of your website.
4. Open the :guilabel:`Sets` section.
5. Add the :guilabel:`Employee Directory` Site Set.
6. Save the site configuration.

The Site Set provides the extension's TypoScript
configuration and configurable site settings.

After installation
==================

After installing the extension, create the necessary
records for departments, job functions, and employees.

Then add one of the Employee Directory plugins to a
TYPO3 page.

For further configuration details, refer to the
Configuration chapter.
