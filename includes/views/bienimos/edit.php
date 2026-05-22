<h1>
            Modifier le bien
            <span class="id-badge">#<?= htmlspecialchars($bienimo['id']) ?></span>
        </h1>
        <span><?= htmlspecialchars($bien['titre']) ?></span>
    </div>
</div>
 
<div class="card">
 
    <div class="info-note">
        Seuls le titre, le statut et le prix de location sont modifiables via cette interface.
    </div>
 
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($bien['id']) ?>">
 
        <div class="form-grid">
 
            <div class="form-group full">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre"
                    value="<?= htmlspecialchars($_POST['titre'] ?? $bien['titre']) ?>" required>
                <?php if (!empty($errors['titre'])): ?>
                    <span class="error"><?= $errors['titre'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <?php
                    $statuts = ['disponible', 'loué', 'maintenance', 'vendu'];
                    $cur = $_POST['statut'] ?? $bien['statut'];
                    foreach ($statuts as $s):
                    ?>
                        <option value="<?= $s ?>" <?= $cur === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['statut'])): ?>
                    <span class="error"><?= $errors['statut'] ?></span>
                <?php endif; ?>
            </div>
 
            <div class="form-group">
                <label for="prix_location">Prix de location (€/mois)</label>
                <input type="number" id="prix_location" name="prix_location"
                    step="0.01" min="0"
                    value="<?= htmlspecialchars($_POST['prix_location'] ?? $bien['prix_location']) ?>" required>
                <?php if (!empty($errors['prix_location'])): ?>
                    <span class="error"><?= $errors['prix_location'] ?></span>
                <?php endif; ?>
            </div>
 
            <!-- Champs en lecture seule (non modifiables par update()) -->
            <div class="form-group">
                <label>Type de bien</label>
                <input type="text" value="<?= htmlspecialchars($bien['type_bien']) ?>" readonly>
            </div>
 
            <div class="form-group">
                <label>Ville</label>
                <input type="text" value="<?= htmlspecialchars($bien['ville']) ?>" readonly>
            </div>
 
            <div class="form-group full">
                <label>Adresse</label>
                <input type="text" value="<?= htmlspecialchars($bien['adresse']) ?>" readonly>
            </div>
 
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="liste.php" class="btn btn-back">← Retour à la liste</a>
            </div>
 
        </div>
    </form>