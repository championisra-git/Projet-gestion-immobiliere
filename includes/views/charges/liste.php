<?php if (empty($charges)): ?>
    <p>Aucune charge trouvée.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Propriété</th>
            <th>Type de dépense</th>
            <th>Montant</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($charges as $charge): ?>
        <tr>
            <td><?= htmlspecialchars($charge['id']) ?></td>
            <td><?= htmlspecialchars($charge['id_proprieté']) ?></td>
            <td><?= htmlspecialchars($charge['type_depense']) ?></td>
            <td><?= number_format($charge['montant'], 2, ',', ' ') ?> FCFA</td>
            <td><?= htmlspecialchars($charge['date_depense']) ?></td>
            <td><?= htmlspecialchars($charge['description']) ?></td>
            <td>
                <a href="index.php?ctrl=charges&action=show&id=<? $charge['id'] ?>">Voir</a>
                <?php if (Auth::role() === 'ADMIN'): ?>
                <a href="index.php?ctrl=charges&action=edit&id=<?= $charge['id'] ?>">Modifier</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>`