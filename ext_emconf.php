<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'CE Fluidtemplates',
    'description' => 'Content element for adding FluidTemplates e.g. as CTAs, conversions, etc.',
    'category' => 'frontend',
    'state' => 'stable',
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'author_company' => 'Web Development Oliver Thiele',
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'OliverThiele\\OtCefluidtemplates\\' => 'Classes',
        ],
    ],
];
