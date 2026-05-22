<?php

require_once 'app/models/maintenance.php';
require_once 'core/Auth.php';

class MaintenanceController {

    private Maintenance $model;

    public function __construct(PDO $pdo) {
        $this->model = new Maintenance($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::require(); 
        $maintenance = $this->model->findAll();
        $pageTitle   = 'Liste des maintenances';       
        $viewFile    = 'app/views/maintenances/liste.php'; 

        require 'app/views/layout/main.php';
    }

    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $maintenance = $this->model->findById($id);
        $pageTitle   = 'maintenance';        
        $viewFile    = 'app/views/maintenance/detail.php';
        if (!$maintenance) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_loyé'  => (int) ($_POST['id_loyé'] ?? 0),
                ':titre' => trim($_POST['titre'] ?? ''),
                ':urgence' => trim($_POST['urgence'] ?? ''),
                ':statut' => trim($_POST['statut'] ?? ''),
                ':date_signalement' => trim($_POST['date_signalement'] ?? ''),
                ':date_resolution' => trim($_POST['date_resolution'] ?? ''),
                ':description' => trim($_POST['description'] ?? '')
                ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=maintenance&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle maintenance';        
            $viewFile    = 'app/views/maintenance/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    // GET+POST — formulaire d'édition
    public function edit(): void {
        Auth::requireRole(['ADMIN','agent']);
        $id = (int) ($_GET['id'] ?? 0);
        $maintenance = $this->model->findById($id);
        if (!$maintenance) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_loyé'=>$_POST['id_loyé'],':titre'=>$_POST['titre'],':urgence'=>$_POST['urgence'],':statut'=>$_POST['statut'],':date_signalement'=>$_POST['date_signalement'],':date_resolution'=>$_POST['date_resolution'],':description'=>$_POST['description']]);
            header('Location: index.php?ctrl=maintenance&action=index');
            exit();
        }
        $pageTitle   = 'Modifier la maintenance';        
        $viewFile    = 'app/views/maintenance/edit.php';
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

    header('Location: index.php?ctrl=maintenance&action=index');
    exit();
}
}
