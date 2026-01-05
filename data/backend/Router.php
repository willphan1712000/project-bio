<?php

namespace config;

use business\user\UserManagement;

interface IRouter
{
    function addRoute($uri, $controller);
    function route($uri);
    function abort();
    function removeLastRoute();
}

class Router
{
    private $routes = [];

    function addRoute($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    function route($uri)
    {
        $base = SystemConfig::URLExtraction();
        $at = substr($base, 0, 1); // Get the first character of the uri
        // If the first character is @ or the landing page "/", go look for a system uri. Otherwise, go look for a user uri
        if ($at == '@' || $at == '') {
            foreach ($this->routes as $route) {
                if ($route['uri'] === $uri) {
                    return require $route['controller'];
                }
            }
        } else {
            if (UserManagement::isUserExist($base)) {
                return require __DIR__ . '/../../dist/user.php';
            }
        }

        $this->abort();
    }

    private function abort()
    {
        http_response_code(404);
        require 'dist/404.php';
        die();
    }

    function removeLastRoute()
    {
        array_pop($this->routes);
    }

    /**
     * This function will add all routes and parse the current route based on the current uri
     */
    public static function router_work()
    {
        $payment = ['checkout', 'return'];
        $user = ['signin', 'signup', 'forgot', 'forgotUsername', 'resetPass', 'restore'];
        $template = ['template'];
        $warning = ['expire', 'deactivate'];
        $admin = ['admin'];
        $document = ['terms', 'privacy', 'pricing'];

        $pages = array_merge($payment, $user, $template, $warning, $admin, $document);

        $router = new Router();
        $router->addRoute('/', 'dist/index.php');
        for ($i = 0; $i < count($pages); $i++) {
            $router->addRoute('/@' . $pages[$i], 'dist/' . $pages[$i] . '.php');
            $router->addRoute('/@' . $pages[$i] . '/', 'dist/' . $pages[$i] . '.php');
        }
        $router->addRoute('/@admin/@upload', 'dist/admin.php');
        $router->addRoute('/@admin/@price', 'dist/admin.php');
        $router->addRoute('/@admin/@logout', 'dist/admin.php');

        $uri = parse_url($_SERVER['REQUEST_URI'])['path']; // Get current uri from the address bar
        $router->route($uri);
    }
}
