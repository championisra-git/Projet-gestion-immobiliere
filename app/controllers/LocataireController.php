<?php

require_once 'app/models/locataire.php';
require_once 'core/Auth.php';

class LocataireController {

    private Locataire $model;

    public function __construct(PDO $pdo) {
        $this->model = new locataire($pdo);
    }

    // GET — liste toutes les charges
    public function index(): void {
        Auth::requireRole(['ADMIN']); 
        $utilisatreur = $this->model->findAll();
        $pageTitle   = 'Liste des locataires';       
        $viewFile    = 'app/views/locataire/liste.php'; 

        require 'app/views/layout/main.php';
    }

    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $locataire = $this->model->findById($id);
        $pageTitle   = 'locataire';        
        $viewFile    = 'app/views/locataire/detail.php';
        if (!$locataire) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':user_id'  => (int) $_POST['user_id'],
                ':addresse'=> trim($_POST['addresse'] ?? ''),
                ':ville'=> trim($_POST['ville'] ?? ''),
                ':pays'=> trim($_POST['pays'] ?? '')
            ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=locataire&action=show&id='.$newId);
            $pageTitle   = 'Nouveveau locataire';        
            $viewFile    = 'app/views/locataire/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    // GET+POST — formulaire d'édition
    public function edit(): void {
        Auth::requireRole(['ADMIN']);
        $id = (int) ($_GET['id'] ?? 0);
        $locataire = $this->model->findById($id);
        if (!$locataire) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':addresse'=>$_POST['addresse'],':ville'=>$_POST['ville'],':pays'=>$_POST['pays']]);
            header('Location: index.php?ctrl=locataire&action=index');
            exit();
        }
        $pageTitle   = 'Modifier locataire';        
        $viewFile    = 'app/views/locataire/edit.php';
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

    header('Location: index.php?ctrl=locataire&action=index');
    exit();
}
}
