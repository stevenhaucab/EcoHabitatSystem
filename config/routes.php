<?php

return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',
        'login' => 'AuthController@showLoginForm', 
        'register' => 'RegisterController@showForm', 
    ],
    'POST' => [
        'login' => 'AuthController@login',
        'register' => 'RegisterController@store',
    ],
    'protected' => [
        '',
        'home',  // Indica que 'home' es una ruta protegida
    ],
];
