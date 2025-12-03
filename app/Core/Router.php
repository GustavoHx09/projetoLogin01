<?php 

namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function add($method, $path, $callback) {
        // código que registra a rota
    }

   public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remover /api_admin do início
        $basePath = '/projetoLogin01';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
            if ($uri === '') $uri = '/';
        }

        $callback = null;
        $params = [];

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $cb) {
                // Transformar rota /users/{id} em regex
                $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([\w\.\-]+)', $route);
                $pattern = '#^' . $pattern . '$#';

                if (preg_match($pattern, $uri, $matches)) {
                    $callback = $cb;
                    // Remove o primeiro elemento, que é a string completa
                    array_shift($matches);
                    $params = $matches;
                    break;
                }
            }
        }

        if (!$callback) {
            http_response_code(404);
            echo "Página não encontrada!";
            return;
        }

        if (is_string($callback)) {
            [$class, $method] = explode('@', $callback);
            $controller = new $class;
            call_user_func_array([$controller, $method], $params);
        } else {
            call_user_func_array($callback, $params);
        }
    }

}
