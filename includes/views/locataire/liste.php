<?php
require_once '../../core/Auth.php';
Auth::check();
$title = "Liste des Locataires";
require_once '../layouts/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des Locataires</h3>
            <a href="Nouveau.php" class="btn btn-primary float-right">+ Nouveau</a>
        </div>
        <div class="card-body">
            <table id="locatairesTable" class="table table-bordered">
                <thead>
                    <tr><th>ID</th><th>Nom</th><th>Email</th><th>Tél</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../config/database.php';
                    $db = new Database();
                    $conn = $db->getConnection();
                    $stmt = $conn->query("SELECT * FROM locataires ORDER BY id DESC");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>" . htmlspecialchars($row['nom'] . ' ' . $row['prenom']) . "</td>
                                <td>{$row['email']}</td>
                                <td>{$row['telephone']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Modifier</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Confirmer ?\")'>Supprimer</a>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../layouts/footer.php'; ?>