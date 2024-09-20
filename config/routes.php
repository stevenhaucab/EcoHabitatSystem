<?php

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
        'login' => 'AuthController@showLoginForm', 
        'register' => 'RegisterController@showForm', 
        'desarrollos' => 'DesarrollosController@index',
        'nuevo-desarrollo' => 'DesarrollosController@create',
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
