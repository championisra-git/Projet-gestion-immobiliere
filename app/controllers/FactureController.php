<?php

require_once 'app/models/facture.php';
require_once 'core/Auth.php';

class FactureController {

    private Facture $model;

    public function __construct(PDO $pdo) {
        $this->model = new facture($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::require(); 
        $properties = $this->model->findAll();
        $pageTitle   = 'Liste de factures';       
        $viewFile    = 'app/views/facture/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $facture = $this->model->findById($id);
        $pageTitle   = 'charge';        
        $viewFile    = 'app/views/facture/detail.php';
        if (!$facture) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_loyer'  => (int) $_POST['id_loyer'],
                ':date_facture' => trim($_POST['date_facture'] ?? ''),
                ':montant_total' => $_POST['montant_total'],
                ':montant_paye' => $_POST['montant_paye'],
                ':statut'     => trim($_POST['statut'] ?? '')
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=facture&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle facture';        
            $viewFile    = 'app/views/facture/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN']);
        $id = (int) ($_GET['id'] ?? 0);
        $facture = $this->model->findById($id);
        if (!$facture) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_loyer'=>$_POST['id_loyer'],':date_facture'=>$_POST['date_facture'],':montant_total'=>$_POST['montant_total'],':montant_paye'=>$_POST['montant_paye'],':statut'=>$_POST['statut']]);
           header('Location: index.php?ctrl=facture&action=index');
            exit();
        }
        $pageTitle   = 'Modifier la facture';        
        $viewFile    = 'app/views/facture/edit.php';
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

    header('Location: index.php?ctrl=facture&action=index');
    exit();
}
}
