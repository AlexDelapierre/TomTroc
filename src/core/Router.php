<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function addRoute(string $url, string $controller, string $method): void
    {
        $this->routes[$url] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function handleRequest(string $url): void
    {
        // On nettoie l'URL (ex: /login?id=1 devient /login)
        $path = parse_url($url, PHP_URL_PATH);

        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $controllerName = $route['controller'];
            $methodName = $route['method'];

            $controller = new $controllerName();

            // On appelle la méthode (ex: $controller->login())
            $controller->$methodName();
        } else {
            // Page 404 si la route n'existe pas
            http_response_code(404);
            echo "Page non trouvée (404)";
        }
    }
}
