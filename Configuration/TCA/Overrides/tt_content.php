<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// 1. Mitarbeiterverzeichnis
ExtensionUtility::registerPlugin(
    'EmployeeDirectory',
    'EmployeeList',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_list.title',
    'employee-directory-plugin',
    'plugins',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_list.description',
    'FILE:EXT:employee_directory/Configuration/FlexForms/EmployeeList.xml'
    );

// 2. Mitarbeiterliste
ExtensionUtility::registerPlugin(
    'EmployeeDirectory',
    'EmployeeListOnly',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_list_only.title',
    'employee-directory-plugin',
    'plugins',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_list_only.description',
    'FILE:EXT:employee_directory/Configuration/FlexForms/EmployeeList.xml'
    );

// 3. Mitarbeiterdetail
ExtensionUtility::registerPlugin(
    'EmployeeDirectory',
    'EmployeeDetail',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_detail.title',
    'employee-directory-plugin',
    'plugins',
    'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.employee_detail.description'
    );

// Datensatzursprung für das kombinierte Plugin
$GLOBALS['TCA']['tt_content']['types']['employeedirectory_employeelist']['showitem'] .=
    ',--div--;LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.record_storage,pages';

// Datensatzursprung für die eigenständige Mitarbeiterliste
$GLOBALS['TCA']['tt_content']['types']['employeedirectory_employeelistonly']['showitem'] .=
    ',--div--;LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:plugin.record_storage,pages';