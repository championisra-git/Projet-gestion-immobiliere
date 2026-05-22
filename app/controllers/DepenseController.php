<?php

require_once 'app/models/charges.php';
require_once 'core/Auth.php';

class DepenseController {

    private Charges $model;

    public function __construct(PDO $pdo) {
        $this->model = new charges($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::require(); 
        $charges = $this->model->findAll();
        $pageTitle   = 'Liste de charges';       
        $viewFile    = 'app/views/charges/liste.php'; 

        require 'app/views/layout/main.php';
    }

    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $bienimo = $this->model->findById($id);
        $pageTitle   = 'charge';        
        $viewFile    = 'app/views/charges/detail.php';
        if (!$bienimo) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_proprieté'  => (int) $_POST['id_proprieté'],
                ':type_depense'     => trim($_POST['type_depense'] ?? ''),
                ':montant' => $_POST['montant'],
                ':date_depense'   => trim($_POST['date_depense'] ?? ''),
                ':description'     => trim($_POST['description'] ?? '')
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=charge&action=show&id='.$newId);
            $pageTitle   = 'Nouvelle depense';        
            $viewFile    = 'app/views/charges/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    // GET+POST — formulaire d'édition
    public function edit(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        $id = (int) ($_GET['id'] ?? 0);
        $charge = $this->model->findById($id);
        if (!$charge) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':id_proprieté'=>$_POST['id_proprieté'], ':type_depense'=>$_POST['type_depense'], ':date_depense'=>$_POST['date_depense'],':description'=>$_POST['description']]);
            header('Location: index.php?ctrl=charge&action=index');
            exit();
        }
        $pageTitle   = 'Modifier la depense';        
        $viewFile    = 'app/views/charges/edit.php';
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

    header('Location: index.php?ctrl=property&action=index');
    exit();
}
}
