<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Employee Directory',
    'description' => 'Manage and display searchable employee profiles with department and job function filters.',
    'category' => 'plugin',
    'author' => 'Dirk Lehmann',
    'author_email' => '',
    'state' => 'stable',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '14.3.0-14.99.99',
            'extbase' => '14.3.0-14.99.99',
            'fluid' => '14.3.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
