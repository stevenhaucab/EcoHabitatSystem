<?php
return [
    'GET' => [
        '' => 'HomeController@index',
        'home' => 'HomeController@index',  // Ruta que deseas proteger
        'someProtectedRoute' => 'SomeProtectedController@someMethod',
    ],
    'POST' => [
        'login' => 'AuthController@login',
    ],
    'protected' => [
        '', 
        'home', 
    ]
];
