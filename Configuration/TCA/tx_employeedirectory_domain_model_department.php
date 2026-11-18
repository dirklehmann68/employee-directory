<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.record',
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
            'showitem' => 'title, description, description_display, detail_link, hidden',
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
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.title',
            'config' => [
                'type' => 'input',
                'max' => 255,
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.description',
            'description' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.description.help',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'description_display' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.description_display',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.description_display.subline',
                        'value' => 'subline',
                    ],
                    [
                        'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.description_display.text',
                        'value' => 'text',
                    ],
                ],
                'default' => 'subline',
            ],
        ],
        'detail_link' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.detail_link',
            'description' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:department.detail_link.help',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['page'],
            ],
        ],
    ],
];