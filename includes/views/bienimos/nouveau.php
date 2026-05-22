<div class="page-header">
    <h1>Ajouter un bien immobilier</h1>
</div>
 
<div class="card">
    <form method="POST" action="nouveau.php">
        <div class="form-grid">
 
            <div class="form-group full">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre"
                    value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>
                <?php if (!empty($errors['titre'])): ?>
                    <span class="error"><?= $errors['titre'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="type_bien">Type de bien</label>
                <select id="type_bien" name="type_bien" required>
                    <option value="">— Choisir —</option>
                    <?php
                    $types = ['Appartement', 'Maison', 'Studio', 'Villa', 'Local commercial', 'Terrain', 'Autre'];
                    $cur = $_POST['type_bien'] ?? '';
                    foreach ($types as $t):
                    ?>
                        <option value="<?= $t ?>" <?= $cur === $t ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['type_bien'])): ?>
                    <span class="error"><?= $errors['type_bien'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <option value="">— Choisir —</option>
                    <?php
                    $statuts = ['disponible', 'loué', 'maintenance', 'vendu'];
                    $cur = $_POST['statut'] ?? '';
                    foreach ($statuts as $s):
                    ?>
                        <option value="<?= $s ?>" <?= $cur === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['statut'])): ?>
                    <span class="error"><?= $errors['statut'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group full">
                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse"
                    value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>" required>
                <?php if (!empty($errors['adresse'])): ?>
                    <span class="error"><?= $errors['adresse'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville"
                    value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" required>
                <?php if (!empty($errors['ville'])): ?>
                    <span class="error"><?= $errors['ville'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="prix_location">Prix de location (€/mois)</label>
                <input type="number" id="prix_location" name="prix_location"
                    step="0.01" min="0"
                    value="<?= htmlspecialchars($_POST['prix_location'] ?? '') ?>" required>
                <?php if (!empty($errors['prix_location'])): ?>
                    <span class="error"><?= $errors['prix_location'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="owner_id">ID Propriétaire</label>
                <input type="number" id="owner_id" name="owner_id"
                    value="<?= htmlspecialchars($_POST['owner_id'] ?? '') ?>" required>
                <?php if (!empty($errors['owner_id'])): ?>
                    <span class="error"><?= $errors['owner_id'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="liste.php" class="btn btn-back">← Retour à la liste</a>
            </div>
 
        </div>
    </form>