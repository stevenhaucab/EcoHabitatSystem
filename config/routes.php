<?php

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
        'desarrollos' => 'DesarrollosController@index',
        'login' => 'AuthController@showLoginForm', 
        'register' => 'RegisterController@showForm', 
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
    ],
    'protected' => [
        '',
        'home',
        'desarrollos',
    ],
];
