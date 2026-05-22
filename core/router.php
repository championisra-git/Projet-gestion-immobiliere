<?php
// core/Router.php

class Router {

    private $ctrl;

    public function routeReq(): void {

        spl_autoload_register(function(string $class): void {
            $paths = [
                dirname(__DIR__) . '/app/models/'      . $class . '.php',
                dirname(__DIR__) . '/app/controllers/' . $class . '.php',
                dirname(__DIR__) . '/core/'            . $class . '.php',
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    require_once $path;
                    return;
                }
            }
        });

        try {
            // URL par défaut → dashboard
            $url = ['dashboard', 'index'];

            if (isset($_GET['url'])) {
                $url = explode(
                    '/',
                    filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL)
                );
            }

            // "property" → "PropertyController"
            $controllerName  = ucfirst(strtolower($url[0] ?? 'dashboard'));
            $controllerClass = $controllerName . 'Controller';
            $controllerFile  = dirname(__DIR__) . '/app/controllers/'
                               . $controllerClass . '.php';

            if (!file_exists($controllerFile)) {
                throw new Exception("Contrôleur introuvable : $controllerClass");
            }

            require_once $controllerFile;

            if (!class_exists($controllerClass)) {
                throw new Exception("Classe introuvable : $controllerClass");
            }

            // Passe le tableau $url complet au contrôleur
            $this->ctrl = new $controllerClass($url);

        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(404);
            require dirname(__DIR__) . '/app/views/404.php';
        }
    }
}