<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.record',
        'label' => 'last_name',
        'prependAtCopy' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:common.copy',
        'hideAtCopy' => true,
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => 'hidden, image, title, first_name, last_name, slug, phone, email, room, location, office_hours, description, department, job_function',
        ],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'image' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.image',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'title' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.title',
            'config' => [
                'type' => 'input',
                'max' => 50,
            ],
        ],
        'first_name' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.first_name',
            'config' => [
                'type' => 'input',
                'max' => 255,
            ],
        ],
        'last_name' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.last_name',
            'config' => [
                'type' => 'input',
                'max' => 255,
                'required' => true,
            ],
        ],
        'slug' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.slug',
            'config' => [
                'type' => 'slug',
                'required' => true,
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title', 'first_name', 'last_name'],
                    'fieldSeparator' => '-',
                    'prefixParentPageSlug' => false,
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'phone' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.phone',
            'config' => [
                'type' => 'input',
                'max' => 50,
            ],
        ],
        'email' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.email',
            'config' => [
                'type' => 'email',
            ],
        ],
        'room' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.room',
            'config' => [
                'type' => 'input',
                'max' => 50,
            ],
        ],
        'location' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.location',
            'config' => [
                'type' => 'input',
                'max' => 50,
            ],
        ],
        'office_hours' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.office_hours',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'department' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.department',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_employeedirectory_domain_model_department',
                'items' => [
                    [
                        'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.department.none',
                        'value' => 0,
                    ],
                ],
            ],
        ],
        'job_function' => [
            'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.job_function',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_employeedirectory_domain_model_jobfunction',
                'items' => [
                    [
                        'label' => 'LLL:EXT:employee_directory/Resources/Private/Language/locallang_db.xlf:employee.job_function.none',
                        'value' => 0,
                    ],
                ],
            ],
        ],
    ],
];