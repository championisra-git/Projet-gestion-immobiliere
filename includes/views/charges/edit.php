<h1> Modifier la charge <span class="id-badge"><?= htmlspecialchars($charge['id']) ?></span>
        </h1>
        <span>Propriété <?= htmlspecialchars($charge['id_propriete']) ?></span>
    </div>
</div>
 
<div class="card">
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($charge['id']) ?>">
 
        <div class="form-group">
            <label for="id_propriete">ID Propriété</label>
            <input
                type="text"
                id="id_propriete"
                name="id_propriete"
                value="<?= htmlspecialchars($_POST['id_propriete'] ?? $charge['id_propriete']) ?>"
                required
            >
            <?php if (!empty($errors['id_propriete'])): ?>
                <span class="error"><?= $errors['id_propriete'] ?></span>
            <?php endif; ?>
        </div>
 
        <div class="form-group">
            <label for="type_depense">Type de dépense</label>
            <select id="type_depense" name="type_depense" required>
                <option value="">— Choisir —</option>
                <?php
                $types = ['Entretien', 'Réparation', 'Taxe', 'Assurance', 'Autre'];
                $current = $_POST['type_depense'] ?? $charge['type_depense'];
                foreach ($types as $type):
                    $selected = ($current === $type) ? 'selected' : '';
                ?>
                    <option value="<?= $type ?>" <?= $selected ?>><?= $type ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['type_depense'])): ?>
                <span class="error"><?= $errors['type_depense'] ?></span>
            <?php endif; ?>
        </div>
 
        <div class="form-group">
            <label for="montant">Montant (€)</label>
            <input
                type="number"
                id="montant"
                name="montant"
                step="0.01"
                min="0"
                value="<?= htmlspecialchars($_POST['montant'] ?? $charge['montant']) ?>"
                required
            >
            <?php if (!empty($errors['montant'])): ?>
                <span class="error"><?= $errors['montant'] ?></span>
            <?php endif; ?>
        </div>
 
        <div class="form-group">
            <label for="date_depense">Date de la dépense</label>
            <input
                type="date"
                id="date_depense"
                name="date_depense"
                value="<?= htmlspecialchars($_POST['date_depense'] ?? $charge['date_depense']) ?>"
                required
            >
            <?php if (!empty($errors['date_depense'])): ?>
                <span class="error"><?= $errors['date_depense'] ?></span>
            <?php endif; ?>
        </div>
 
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? $charge['description'] ?? '') ?></textarea>
            <?php if (!empty($errors['description'])): ?>
                <span class="error"><?= $errors['description'] ?></span>
            <?php endif; ?>
        </div>
 
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="index.php" class="btn btn-back">← Retour à la liste</a>
        </div>
 
    </form>
</div>