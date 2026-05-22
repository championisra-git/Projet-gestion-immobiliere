<?php

require_once 'app/models/utilisateurs.php';
require_once 'core/Auth.php';

class UserController {

    private Utilisateur $model;

    public function __construct(PDO $pdo) {
        $this->model = new Utilisateur($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::requireRole(['ADMIN']); 
        $utilisatreur = $this->model->findAll();
        $pageTitle   = 'Liste des utilisatreurs';       
        $viewFile    = 'app/views/utilisatreur/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $utilisateur = $this->model->findById($id);
        $pageTitle   = 'Utilisateur';        
        $viewFile    = 'app/views/utilisateur/detail.php';
        if (!$utilisateur) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id' => null,
                ':nom' => trim($_POST['nom'] ?? ''),
                ':prenom' => trim($_POST['prenom'] ?? ''),
                ':email' => trim($_POST['email'] ?? ''),
                ':password' => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
                ':telephone' => trim($_POST['telephone'] ?? ''),
                ':role' => $_POST['role'] ?? 'USER',
                ':date_creation' => date('Y-m-d H:i:s'),
                ':actif' => 1
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=utilisateur&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle utilisateur';        
            $viewFile    = 'app/views/utilisateur/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    // GET+POST — formulaire d'édition
    public function edit(): void {
        Auth::requireRole(['ADMIN']);
        $id = (int) ($_GET['id'] ?? 0);
        $facture = $this->model->findById($id);
        if (!$facture) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           header('Location: index.php?ctrl=utilisateur&action=index');
            exit();
        }
        $pageTitle   = 'Modifier llutilisateur';        
        $viewFile    = 'app/views/utilisateur/edit.php';
        require 'app/views/layout/main.php';
    }

    // GET — suppression
  public function delete(): void {

    Auth::requireRole(['ADMIN']);

    $id = (int) ($_GET['id'] ?? 0);


    if ($id <= 0) {
        die('ID invalide');
    }

    $deleted = $this->model->delete($id);

    if (!$deleted) {
        die('Suppression refusée');
    }

    header('Location: index.php?ctrl=utilisateur&action=index');
    exit();
}
}
