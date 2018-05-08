<?php
namespace config;
return [

    '' => [
        'controller' => 'Home',
        'action' => 'Advertising'
    ],

    'main' => [
        'controller' => 'Home',
        'action' => 'Index'
    ],
    'apartment\?.*' => [
        'controller' => 'Home',
        'action' => 'ShowApartment'
    ],
    'signup' => [
        'controller' => 'Account',
        'action' => 'signup'
    ]


];