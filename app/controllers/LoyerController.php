<?php

require_once 'app/models/contrat_location.php';
require_once 'core/Auth.php';

class LoyerController {

    private Contract_location $model;

    public function __construct(PDO $pdo) {
        $this->model = new Contract_location($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::require(); 
        $properties = $this->model->findAll();
        $pageTitle   = 'Liste des loyers';       
        $viewFile    = 'app/views/loyers/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $contract_location = $this->model->findById($id);
        $pageTitle   = 'Contract_location';        
        $viewFile    = 'app/views/loyers/detail.php';
        if (!$contract_location) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT','proprietaire']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':owner_id'  => (int) $_POST['owner_id'],
                ':titre' => trim($_POST['titre'] ?? ''),
                ':type_bien' => trim($_POST['type_bien']),
                ':addresse' => trim($_POST['addresse']),
                ':ville'     => trim($_POST['ville'] ?? '')
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=loyer&action=show&id='.$newId);
            $pageTitle   = 'Nouveau contract de location';        
            $viewFile    = 'app/views/loyers/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN', 'agent','proprietaire']);
        $id = (int) ($_GET['id'] ?? 0);
        $loyer = $this->model->findById($id);
        if (!$loyer) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_proprieté'=>$_POST['id_proprieté'],':id_locataire'=>$_POST['id_locataire'],':date_debut'=>$_POST['date_debut'],':date_fin'=>$_POST['date_fin']]);
            header('Location: index.php?ctrl=loyer&action=index');
            exit();
        }
        $pageTitle   = 'Modifier le contract';        
        $viewFile    = 'app/views/loyers/edit.php';
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

    header('Location: index.php?ctrl=loyer&action=index');
    exit();
}
}
