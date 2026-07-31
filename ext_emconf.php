<?php

$EM_CONF['ot_cefluidtemplates'] = [
    'title' => 'CE Fluidtemplates',
    'description' => 'Content element for adding FluidTemplates e.g. as CTAs, conversions, etc.',
    'category' => 'frontend',
    'state' => 'stable',
    'author' => 'Oliver Thiele',
    'author_email' => 'mail@oliver-thiele.de',
    'author_company' => 'Web Development Oliver Thiele',
    'version' => '5.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.3.0-14.99.99',
            'php' => '8.4.0-8.99.99',
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
