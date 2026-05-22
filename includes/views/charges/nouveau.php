<h1>Ajouter une charge</h1>
 
<form method="POST" action="store.php">
 
    <label for="id_propriété">ID Propriété</label>
    <input type="text" id="id_propriété" name="id_propriété"
           value="<?= htmlspecialchars($_POST['id_propriété'] ?? '') ?>" required>
    <?php if (!empty($errors['id_propriété'])): ?>
        <span class="error"><?= $errors['id_propriété'] ?></span>
    <?php endif; ?>
 
    <label for="type_depense">Type de dépense</label>
    <select id="type_depense" name="type_depense" required>
        <option value="">-- Choisir --</option>
        <?php
        $types = ['Entretien', 'Réparation', 'Taxe', 'Assurance', 'Autre'];
        foreach ($types as $type):
            $selected = (($_POST['type_depense'] ?? '') === $type) ? 'selected' : '';
        ?>
            <option value="<?= $type ?>" <?= $selected ?>><?= $type ?></option>
        <?php endforeach; ?>
    </select>
    <?php if (!empty($errors['type_depense'])): ?>
        <span class="error"><?= $errors['type_depense'] ?></span>
    <?php endif; ?>
 
    <label for="montant">Montant (FCFA)</label>
    <input type="number" id="montant" name="montant" step="0.01" min="0"
           value="<?= htmlspecialchars($_POST['montant'] ?? '') ?>" required>
    <?php if (!empty($errors['montant'])): ?>
        <span class="error"><?= $errors['montant'] ?></span>
    <?php endif; ?>
 
    <label for="date_depense">Date de la dépense</label>
    <input type="date" id="date_depense" name="date_depense"
           value="<?= htmlspecialchars($_POST['date_depense'] ?? date('Y-m-d')) ?>" required>
    <?php if (!empty($errors['date_depense'])): ?>
        <span class="error"><?= $errors['date_depense'] ?></span>
    <?php endif; ?>
 
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
 
    <button type="submit">Enregistrer</button>
</form>
 
<a href="liste.php">← Retour à la liste</a>