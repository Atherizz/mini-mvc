<?php
session_start();

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/mini-mvc/public');

require BASE_PATH . '/app/helpers.php';
require BASE_PATH . '/app/Http/Middleware/AuthMiddleware.php';

$routes = require BASE_PATH . '/routes/web.php';

spl_autoload_register(function ($class) {
    $controllerFile = BASE_PATH . '/app/Http/Controllers/' . $class . '.php';
    if (file_exists($controllerFile)) {
        require $controllerFile;
        return;
    }

    $modelFile = BASE_PATH . '/app/Models/' . $class . '.php';
    if (file_exists($modelFile)) {
        require $modelFile;
        return;
    }

    $coreFile = BASE_PATH . '/app/Core/' . $class . '.php';
    if (file_exists($coreFile)) {
        require $coreFile;
        return;
    }
});


$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 

$base_path = '/mini-mvc/public';

if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

if (empty($request_uri) || $request_uri[0] !== '/') {
    $request_uri = '/' . $request_uri;
}

$path = $request_uri ?: '/';
$method = $_SERVER['REQUEST_METHOD'];


$routesForMethod = $routes[$method] ?? [];
$routeFound = false;

foreach ($routesForMethod as $routePath => $routeInfo) {
    // Ubah route path (e.g., /ekskul/detail/{id}) menjadi pola Regex
    // Ini akan mengubah {id} menjadi ([a-zA-Z0-9_]+)
    $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routePath);
    
    // Buat pola Regex yang utuh (tambahkan ^ dan $ agar cocok persis)
    $pattern = "#^" . $pattern . "$#";

    // cocokkan URL saat ini dengan pola Regex
    if (preg_match($pattern, $path, $matches)) {
        
        array_shift($matches); 
        $params = $matches;

        $controllerName = $routeInfo['controller'];
        $action = $routeInfo['action'];
        
        if (isset($routeInfo['middleware'])) {
            $auth = new AuthMiddleware();

            if ($routeInfo['middleware'] === 'auth') {
                $auth->requireLogin(); 
            } elseif ($routeInfo['middleware'] === 'admin') {
                $auth->requireAdmin(); 
            }
        }

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
                
                $routeFound = true;
                break; 
            } else {
                echo "Action not found!";
                $routeFound = true;
                break;
            }
        } else {
            echo "Controller not found!";
            $routeFound = true; 
            break;
        }
    }
}

if (!$routeFound) {
    echo "404 - Page not found!";
}