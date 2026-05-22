<?php

require_once 'app/models/paiement.php';
require_once 'core/Auth.php';

class PayementController {

    private  Paiement $model;

    public function __construct(PDO $pdo) {
        $this->model = new paiement($pdo);
    }

    public function index(): void {
        Auth::require(); 
        $paiement = $this->model->findAll();
        $pageTitle   = 'Liste des paiement';       
        $viewFile    = 'app/views/paiement/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id_loyer = (int) ($_GET['id_loyer'] ?? 0);
        $paiement = $this->model->findparloyer($id_loyer);
        $pageTitle   = 'charge';        
        $viewFile    = 'app/views/paiement/detail.php';
        if (!$paiement) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_loyer'  => (int) $_POST['id_loyer'],
                ':mois_concerne' => trim($_POST['mois_concerne'] ?? ''),
                ':montant' => (int)($_POST['montant']),
                ':date_paiement' => $_POST['date_paiement'],
                ':mode_paiement' => trim($_POST['mode_paiement'] ?? ''),
                ':statut' => trim($_POST['statut'] ?? '')

            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=paiement&action=show&id='.$newId);
            $pageTitle   = 'Nouveau paiement';        
            $viewFile    = 'app/views/paiement/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN']);
        $id = (int) ($_GET['id'] ?? 0);
        $paiement = $this->model->findById($id);
        if (!$paiement) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_loyer'=>$_POST['id_loyer'],':mois_concerne'=>$_POST['mois_concerne'],':date_paiement'=>$_POST['date_paiement'],':mode_paiement'=>$_POST['mode_paiement'],':statut'=>$_POST['statut']]);
            header('Location: index.php?ctrl=paiement&action=index');
            exit();
        }
        $pageTitle   = 'Modifier le paiement';        
        $viewFile    = 'app/views/paiement/edit.php';
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

    header('Location: index.php?ctrl=paiement&action=index');
    exit();
}
}
