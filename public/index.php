<?php
session_start();

// Define the BASE_URL for use in redirections
$base_url = 'http://' . $_SERVER['HTTP_HOST'];
define('BASE_URL', $base_url);

// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        '../app/controllers/',
        '../app/models/',
        '../system/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    echo "File for class $class not found.";
});

// Include routes
require_once '../app/routes/web.php';

// Parse the request
$requestUri = $_SERVER['REQUEST_URI'];
$request = trim(parse_url($requestUri, PHP_URL_PATH), '/');

// Match routes and extract parameters
$controllerName = null;
$methodName = null;
$params = [];



foreach ($routes as $route => $handler) {
    // Convert route patterns (e.g., 'admin/products/delete/{id}') into regex
    $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route);
    $pattern = '#^' . $pattern . '$#';

    if (preg_match($pattern, $request, $matches)) {
        list($controllerName, $methodName) = explode('@', $handler);
        $params = array_slice($matches, 1); // Extract dynamic parameters
        break;
    }
}

// Default route
if (!$controllerName && !$methodName) {
    if ($request === '' || $request === '/') {
        $controllerName = 'HomeController';
        $methodName = 'index';
    } else {
        http_response_code(404);
        require_once '../app/views/errors/404.php';
        exit;
    }
}



// Instantiate the controller and call the method
try {
    if (!class_exists($controllerName)) {
        throw new Exception("Controller $controllerName not found.");
    }

    $controller = new $controllerName();

    if (!method_exists($controller, $methodName)) {
        throw new Exception("Method $methodName not found in controller $controllerName.");
    }

    call_user_func_array([$controller, $methodName], $params);
} catch (Exception $e) {
    http_response_code(404);
    require_once '../app/views/errors/404.php';
    exit;
}
