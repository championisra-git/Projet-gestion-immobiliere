<h1>Biens Immobiliers</h1>
<span>Gestion du parc immobilier</span>
<a href="nouveau.php" class="btn btn-primary">+ Ajouter un bien</a>
 
<!-- Filtres -->
<form method="GET" class="filters">
    <select name="statut">
        <option value="">Tous les statuts</option>
        <?php
        $statuts = ['disponible', 'loué', 'maintenance', 'vendu'];
        foreach ($statuts as $s):
            $sel = (($_GET['statut'] ?? '') === $s) ? 'selected' : '';
        ?>
            <option value="<?= $s ?>" <?= $sel ?>><?= ucfirst($s) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary">Filtrer</button>
    <a href="liste.php" class="btn btn-edit">Réinitialiser</a>
</form>
 
<?php if (empty($biens)): ?>
    <div class="empty">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <p>Aucun bien immobilier enregistré.</p>
    </div>
<?php else: ?>
    <div class="grid">
        <?php foreach ($biens as $b):
            $badgeClass = match($b['statut']) {
                'disponible'  => 'badge-disponible',
                'loué'        => 'badge-loue',
                'maintenance' => 'badge-maintenance',
                'vendu'       => 'badge-vendu',
                default       => 'badge-vendu',
            };
        ?>
        <div class="card">
            <div class="card-header">
                <h2><?= htmlspecialchars($b['titre']) ?></h2>
                <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($b['statut']) ?></span>
            </div>
            <div class="card-body">
                <div class="card-meta">
                    <div class="meta-row">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                        <?= htmlspecialchars($b['type_bien']) ?>
                    </div>
                    <div class="meta-row">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?= htmlspecialchars($b['adresse']) ?>, <?= htmlspecialchars($b['ville']) ?>
                    </div>
                </div>
                <div class="prix">
                    <?= number_format($b['prix_location'], 2, ',', ' ') ?> €
                    <span>/ mois</span>
                </div>
            </div>
            <div class="card-footer">
                <a href="show.php?id=<?= $b['id'] ?>" class="btn btn-show">Voir</a>
                <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-edit">Modifier</a>
                <a href="delete.php?id=<?= $b['id'] ?>" class="btn btn-danger"
                   onclick="return confirm('Supprimer ce bien ?')">Supprimer</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>