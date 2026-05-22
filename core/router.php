<?php
// core/Router.php

class Router {

    private PDO $pdo;

    // Mapping ctrl → fichier contrôleur + classe
    private array $routes = [
        'auth'        => ['AuthController',        'app/controllers/AuthController.php'],
        'utilisateur' => ['UserController',        'app/controllers/UserController.php'],
        'bienimo'     => ['ControllerBien',        'app/controllers/ControllerBien.php'],
        'proprietaire'=> ['ProprietaireController','app/controllers/ProprietaireController.php'],
        'locataire'   => ['LocataireController',   'app/controllers/LocataireController.php'],
        'loyer'       => ['LoyerController',       'app/controllers/LoyerController.php'],
        'paiement'    => ['PaymentController',     'app/controllers/PaymentController.php'],
        'factures'    => ['FactureController',     'app/controllers/FactureController.php'],
        'charges'     => ['DepenseController',     'app/controllers/DepenseController.php'],
        'maintenance' => ['MaintenanceController', 'app/controllers/MaintenanceController.php'],
        'visite'      => ['VisiteController',      'app/controllers/VisiteController.php'],
    ];

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function dispatch(string $ctrl, string $action): void {
        if (!isset($this->routes[$ctrl])) {
            http_response_code(404);
            require 'app/views/404.php';
            return;
        }

        [$class, $file] = $this->routes[$ctrl];
        require_once $file;

        $controller = new $class($this->pdo);

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            require 'app/views/404.php';
            return;
        }

        $controller->$action();
    }
}