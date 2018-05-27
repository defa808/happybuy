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
    'registration' => [
        'controller' => 'Account',
        'action' => 'registration'
    ],
    'login' => [
        'controller' => 'Account',
        'action' => 'login'
    ],
    'account/confirm/{token:\w+}' => [
        'controller' => 'Account',
        'action' => 'confirm',
    ],
    'logout' => [
        'controller' => 'Account',
        'action' => 'logOut'
    ]

];