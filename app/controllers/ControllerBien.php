<?php

require_once 'app/models/bienimo.php';
require_once 'core/Auth.php';

class ControllerBien {

    private Bienimo $model;

    public function __construct(PDO $pdo) {
        $this->model = new bienimo($pdo);
    }

    // GET — liste tous les biens
    public function index(): void {
        Auth::require(); // vérifie la session
        $properties = $this->model->findAll();
        $pageTitle   = 'Liste de biens immobiliers';        //afficher par le layout
        $viewFile    = 'app/views/bienimos/liste.php'; // vue à injecter

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $bienimo = $this->model->findById($id);
        $pageTitle   = 'Détail de la propriété';        
        $viewFile    = 'app/views/bienimos/detail.php';
        if (!$bienimo) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }

    // GET+POST — formulaire d'ajout
    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':owner_id'  => (int) $_POST['owner_id'],
                ':titre'     => trim($_POST['titre'] ?? ''),
                ':type_bien' => $_POST['type_bien'],
                ':adresse'   => trim($_POST['adresse'] ?? ''),
                ':ville'     => trim($_POST['ville'] ?? ''),
                ':statut'    => 'DISPONIBLE',
                ':prix'      => (float) $_POST['prix_location'],
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=property&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle propriété';        
            $viewFile    = 'app/views/bienimos/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        $id = (int) ($_GET['id'] ?? 0);
        $property = $this->model->findById($id);
        if (!$property) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':titre'=>$_POST['titre'],':statut'=>$_POST['statut'],':prix_location'=>$_POST['prix_location']]);
            header('Location: index.php?ctrl=bienimo&action=index');
            exit();
        }
        $pageTitle   = 'Modifier la propriété';        
        $viewFile    = 'app/views/bienimos/edit.php';
        require 'app/views/layout/main.php';
    }

    // GET — suppression
  public function delete(): void {

    Auth::requireRole(['ADMIN', 'proprietaire']);

    $id = (int) ($_GET['id'] ?? 0);

    $owner_id = $_SESSION['user']['id'];

    if ($id <= 0) {
        die('ID invalide');
    }

    $deleted = $this->model->delete($id, $owner_id);

    if (!$deleted) {
        die('Suppression refusée');
    }

    header('Location: index.php?ctrl=bienimo&action=index');
    exit();
}
}
