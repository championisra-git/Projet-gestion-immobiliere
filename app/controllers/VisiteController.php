<?php

require_once 'app/models/visite.php';
require_once 'core/Auth.php';

class VisiteController {

    private Visite $model;

    public function __construct(PDO $pdo) {
        $this->model = new Visite($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::require(); 
        $visite = $this->model->findAll();
        $pageTitle   = 'Liste des visites';       
        $viewFile    = 'app/views/visite/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $visite = $this->model->findById($id);
        $pageTitle   = 'visite';        
        $viewFile    = 'app/views/visite/detail.php';
        if (!$visite) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'agent','proprietaire','locataire']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_proprieté'  => (int) $_POST['id_proprieté'],
                ':nom_visiteur' => trim($_POST['nom_visiteur'] ?? ''),
                ':telephone_visiteur' => (int)($_POST['telephone_visiteur']),
                ':email_visiteur' => trim($_POST['email_visiteur']),
                ':date_visite'     => ($_POST['date_visite'] ?? ''),
                ':statut' => trim($_POST['statut']),
                ':note_agent' => (int)($_POST['note_agent']),
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=visite&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle visite';        
            $viewFile    = 'app/views/visite/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN','proprietaire','agent']);
        $id = (int) ($_GET['id'] ?? 0);
        $visite = $this->model->findById($id);
        if (!$visite) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_proprieté'=>$_POST['id_proprieté'],':nom_visiteur'=>$_POST['nom_visiteur'],':telephone_visiteur'=>$_POST['telephone_visiteur'],':email_visiteur'=>$_POST['email_visiteur'],':date_visite'=>$_POST['date_visite'],':statut'=>$_POST['statut'],':note_agent'=>$_POST['note_agent']]);
            header('Location: index.php?ctrl=visite&action=index');
            exit();
        }
        $pageTitle   = 'Modifier la visite';        
        $viewFile    = 'app/views/visite/edit.php';
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

    header('Location: index.php?ctrl=visite&action=index');
    exit();
}
}
