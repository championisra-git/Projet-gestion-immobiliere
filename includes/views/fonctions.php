<?
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php';

function connexion():void{
    global $pdo;
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identification = trim($_POST['user_id'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($identification){
            $stmt = $pdo->prepare('SELECT * FROM client WHERE email = ?');
            $stmt->execute([$identification]);
            $client = $stmt->fetch(PDO::FETCH_ASSOC);
        }elseif($identification){
            $stmt = $pdo->prepare('SELECT * FROM client WHERE nom = ?');
            $stmt->execute([$identification]);
            $client = $stmt->fetch(PDO::FETCH_ASSOC);    
        }
    // Vérifier le mot de passe
    if ($client && password_verify($password, $client['mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $client['id'];
        $_SESSION['user_nom'] = $client['nom'];
        header('Location: tableau_de_bord.php');
        exit;
    }else {
        $erreur = 'identifiant utilisateur ou mot de passe incorrect.';
    }
    }
}

function liste($objets): void{

    global $pdo;
    // Récupérer tous les utilisateurs
    $stmt = $pdo->query('SELECT * FROM ? ');
    $objets = $stmt->fetchAll(); // tableau de tableaux associatifs
    foreach ($objets as $objet) {
    echo $objet.' <br>';
    }

}




    


