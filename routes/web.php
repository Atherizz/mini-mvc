<?php 

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController; 

return [
    'GET' => [
        // 2. Gunakan ::class
        '/login' => ['controller' => AuthController::class, 'action' => 'login_view', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register_view', 'middleware' => 'guest'],

        '/' => ['controller' => HomeController::class, 'action' => 'index', 'middleware' => 'guest'],
        '/home' => ['controller' => HomeController::class, 'action' => 'index', 'middleware' => 'guest'],
        '/about' => ['controller' => AboutController::class, 'action' => 'index', 'middleware' => 'guest'],
        '/post/{id}' => ['controller' => PostController::class, 'action' => 'detail', 'middleware' => 'guest'],
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login_post', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register_post', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
    ],
];
?>