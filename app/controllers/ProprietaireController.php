<?php

require_once 'app/models/proprietaire.php';
require_once 'core/Auth.php';

class ProprietaireController {

    private Proprietaire $model;

    public function __construct(PDO $pdo) {
        $this->model = new proprietaire($pdo);
    }

    public function index(): void {
        Auth::require(); 
        $proprietaire = $this->model->findAll();
        $pageTitle   = 'Liste des proprietaire';       
        $viewFile    = 'app/views/proprietaire/liste.php'; 

        require 'app/views/layout/main.php';
    }

    // GET — détail d'un bien
    public function show(): void {
        Auth::require();
        $id = (int) ($_GET['id'] ?? 0);
        $proprietaire = $this->model->findById($id);
        $pageTitle   = 'proprietaire';        
        $viewFile    = 'app/views/proprietaire/detail.php';
        if (!$proprietaire) { http_response_code(404); require 'app/views/404.php'; return; }
        require 'app/views/layout/main.php';
    }
    

    public function create(): void {
        Auth::requireRole(['ADMIN', 'AGENT']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':id_user'  => (int) $_POST['id_user'],
                ':addresse' => trim($_POST['addresse'] ?? ''),
                ':ville' => trim($_POST['ville']),
                ':pays' => trim($_POST['pays']),
          ];
            $newId = $this->model->create($data);
            header('Location: index.php?ctrl=proprietaire&action=show&id='.$newId);
            $pageTitle   = 'Nouveau proprietaire';        
            $viewFile    = 'app/views/proprietaire/nouveau.php';
            exit();
        }
        require 'app/views/layout/main.php';
    }

    public function edit(): void {
        Auth::requireRole(['ADMIN']);
        $id = (int) ($_GET['id'] ?? 0);
        $proprietaire = $this->model->findById($id);
        if (!$proprietaire) { http_response_code(404); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [':addresse'=>$_POST['addresse'],':ville'=>$_POST['ville'],':pays'=>$_POST['pays']]);
            header('Location: index.php?ctrl=proprietaire&action=index');
            exit();
        }
        $pageTitle   = 'Modifier un proprietaire';        
        $viewFile    = 'app/views/proprietaire/edit.php';
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

    header('Location: index.php?ctrl=proprietaire&action=index');
    exit();
}
}
