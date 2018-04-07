<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'main',
        'access' => 0,
        'ajax-only' => false
    ],
    'downloads' => [
        'controller' => 'main',
        'action' => 'downloads',
        'access' => 0,
        'ajax-only' => false
    ],
    'guides' => [
        'controller' => 'main',
        'action' => 'guides',
        'access' => 0,
        'ajax-only' => false
    ],
    'contacts' => [
        'controller' => 'main',
        'action' => 'contacts',
        'access' => 0,
        'ajax-only' => false
    ],
    // АВТОРИЗАЦИЯ
    'auth/check_name' => [
        'controller' => 'users',
        'action' => 'checkName',
        'access' => 0,
        'ajax-only' => true
    ],
    'auth/check_email' => [
        'controller' => 'users',
        'action' => 'checkEmail',
        'access' => 0,
        'ajax-only' => true
    ],
    'reg' => [
        'controller' => 'users',
        'action' => 'reg',
        'access' => 0,
        'ajax-only' => true
    ],
    'auth' => [
        'controller' => 'users',
        'action' => 'auth',
        'access' => 0,
        'ajax-only' => true
    ],
    'leave' => [
        'controller' => 'users',
        'action' => 'leave',
        'access' => 0,
        'ajax-only' => true
    ]
];
