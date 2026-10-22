<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// 1. Mitarbeiterverzeichnis: LIST + SHOW
ExtensionUtility::configurePlugin(
    'EmployeeDirectory',
    'EmployeeList',
    [
        \DirkLehmann\EmployeeDirectory\Controller\EmployeeController::class => 'list, show, filter',
    ],
    []
);

// 2. Mitarbeiterliste: nur LIST
ExtensionUtility::configurePlugin(
    'EmployeeDirectory',
    'EmployeeListOnly',
    [
        \DirkLehmann\EmployeeDirectory\Controller\EmployeeController::class => 'list, filter',
    ],
    []
);

// 3. Mitarbeiterdetail: nur SHOW
ExtensionUtility::configurePlugin(
    'EmployeeDirectory',
    'EmployeeDetail',
    [
        \DirkLehmann\EmployeeDirectory\Controller\EmployeeController::class => 'show',
    ],
    []
);

// Löschschutz für zugewiesene Abteilungen und Funktionen
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']
    ['t3lib/class.t3lib_tcemain.php']
    ['processCmdmapClass']
    ['employee_directory'] =
        \DirkLehmann\EmployeeDirectory\Hooks\PreventAssignedRecordDeletionHook::class;