<?php
// app/views/layouts/main.php
// Variables attendues : $pageTitle, $content (ou require inline)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($pageTitle ?? 'Imog') ?></title>
  <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
  <nav>
    <?php require 'app/views/layouts/nav.php'; ?>
  </nav>
  <main>
    <?php require $viewFile; // injecté par le contrôleur ?>
  </main>
</body>
</html>