<?php
require_once '../../core/Auth.php';
Auth::check();
require_once '../../config/database.php';

$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM locataires WHERE id = ?");
$stmt->execute([$id]);
$locataire = $stmt->fetch(PDO::FETCH_ASSOC);

$title = "Modifier Locataire";
require_once '../layouts/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Modifier locataire</h3>
            <a href="liste.php" class="btn btn-secondary float-right">Retour</a>
        </div>
        <form action="../../core/process_locataire.php" method="POST">
            <input type="hidden" name="id" value="<?= $locataire['id'] ?>">
            <div class="card-body">
                <div class="form-group"><label>Nom</label><input type="text" name="nom" value="<?= htmlspecialchars($locataire['nom']) ?>" class="form-control" required></div>
                <div class="form-group"><label>Prénom</label><input type="text" name="prenom" value="<?= htmlspecialchars($locataire['prenom']) ?>" class="form-control" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" value="<?= $locataire['email'] ?>" class="form-control" required></div>
                <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" value="<?= $locataire['telephone'] ?>" class="form-control" required></div>
                <div class="form-group"><label>Adresse</label><textarea name="adresse" class="form-control" rows="2"><?= htmlspecialchars($locataire['adresse']) ?></textarea></div>
                <div class="form-group"><label>Nouveau mot de passe</label><input type="password" name="password" class="form-control" placeholder="Laisser vide pour ne pas changer"></div>
            </div>
            <div class="card-footer">
                <button type="submit" name="action" value="update" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
<?php require_once '../layouts/footer.php'; ?>