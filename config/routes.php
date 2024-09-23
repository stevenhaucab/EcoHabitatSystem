<?php

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
        'login' => 'AuthController@showLoginForm', 
        'register' => 'RegisterController@showForm', 
        'desarrollos' => 'DesarrollosController@index',
        'nuevo-desarrollo' => 'DesarrollosController@create',
        'editar-desarrollo/{id}' => 'DesarrollosController@edit',
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
        'nuevo-desarrollo' => 'DesarrollosController@store',
        'editar-desarrollo/{id}' => 'DesarrollosController@update',
    ],
    'protected' => [
        '',
        'home',
        'desarrollos',
    ],
];
