<?php

define('DB_HOST', 'localhost');
define('DB_PORT', '3307');
define('DB_NAME', 'imogdb') ;
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
try {
    $dsn = 'mysql:host=' . DB_HOST . ';port='.DB_PORT.';dbname='. DB_NAME .';charset=' . DB_CHARSET;
    $options = [
    PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO:: ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO:: ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
}catch (PDOException $e) {
    // En production : logger l'erreur, afficher message générique error_1og($e-›geMessage()) ;
die ('Erreur de connexion à la base de données. ');
}
?>