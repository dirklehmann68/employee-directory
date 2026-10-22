<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:job_function.record',
        'label' => 'title',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:common.copy',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => 'title, hidden',
        ],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'title' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:job_function.title',
            'config' => [
                'type' => 'input',
                'max' => 255,
                'required' => true,
            ],
        ],
    ],
];