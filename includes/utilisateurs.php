<?php 
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php';

// Récupérer tous les utilisateurs
    $stmt = $pdo->query('SELECT * FROM utilisateur ORDER BY id_user ASC');
    $utilisateur = $stmt->fetchAll(); // tableau de tableaux associatifs
    foreach ($utilisateur as $user) {
    echo $user['id_user'] . ' . ' . $user['nom'] .' '.$user['prenom'].':'.$user['role'].' <br>';
    }