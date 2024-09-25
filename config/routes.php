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
        'etapas' => 'EtapasController@index',
        'etapas/desarrollo/{idDesarrollo}' => 'EtapasController@index',
        'nuevo-etapa' => 'EtapasController@create',
        'editar-etapa/{id}' => 'EtapasController@edit',
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
        'nuevo-desarrollo' => 'DesarrollosController@store',
        'editar-desarrollo/{id}' => 'DesarrollosController@update',
        'nuevo-etapa' => 'EtapasController@store',
        'editar-etapa/{id}' => 'EtapasController@update',
    ],
    'protected' => [
        '',
        'home',
        'desarrollos',
    ],
];
