<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'CE Fluidtemplates',
    'description' => '',
    'category' => 'frontend',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => false,
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'author_company' => 'Web Development Oliver Thiele',
    'constraints' => [
        'depends' => [],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'OliverThiele\\OtCefluidtemplates\\' => 'Classes'
        ]
    ]
];
