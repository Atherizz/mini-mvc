<?php 

return [
    'GET' => [
        '/login' => ['controller' => 'AuthController', 'action' => 'login_view', 'middleware' => 'guest'],
        '/register' => ['controller' => 'AuthController', 'action' => 'register_view', 'middleware' => 'guest'],

        '/' => ['controller' => 'HomeController', 'action' => 'index', 'middleware' => 'guest'],
        '/home' => ['controller' => 'HomeController', 'action' => 'index', 'middleware' => 'guest'],
        '/about' => ['controller' => 'AboutController', 'action' => 'index', 'middleware' => 'guest'],
        '/post/{id}' => ['controller' => 'Postontroller', 'action' => 'detail', 'middleware' => 'guest'],
    ],
    'POST' => [
        '/login' => ['controller' => 'AuthController', 'action' => 'login_post', 'middleware' => 'guest'],
        '/register' => ['controller' => 'AuthController', 'action' => 'register_post', 'middleware' => 'guest'],
        '/logout' => ['controller' => 'AuthController', 'action' => 'logout', 'middleware' => 'auth'],
    ],
];
?>