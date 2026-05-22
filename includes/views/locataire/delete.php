<?php
require_once '../../core/Auth.php';
Auth::check();
require_once '../../config/database.php';

$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];

// Vérifier s'il a des contrats
$check = $conn->prepare("SELECT COUNT(*) FROM contrats WHERE locataire_id = ?");
$check->execute([$id]);
if($check->fetchColumn() > 0) {
    $_SESSION['error'] = "Ce locataire a des contrats, suppression impossible";
} else {
    $stmt = $conn->prepare("DELETE FROM locataires WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['success'] = "Locataire supprimé";
}
header('Location: liste.php');
?>