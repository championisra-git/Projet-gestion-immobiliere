<?php
require_once '../../core/Auth.php';
Auth::check();
$title = "Nouveau Locataire";
require_once '../layouts/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Ajouter un locataire</h3>
            <a href="liste.php" class="btn btn-secondary float-right">Retour</a>
        </div>
        <form action="../../core/process_locataire.php" method="POST">
            <div class="card-body">
                <div class="form-group"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
                <div class="form-group"><label>Prénom</label><input type="text" name="prenom" class="form-control" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" class="form-control" required></div>
                <div class="form-group"><label>Adresse</label><textarea name="adresse" class="form-control" rows="2"></textarea></div>
                <div class="form-group"><label>Mot de passe</label><input type="password" name="password" class="form-control" required></div>
            </div>
            <div class="card-footer">
                <button type="submit" name="action" value="create" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<?php require_once '../layouts/footer.php'; ?>