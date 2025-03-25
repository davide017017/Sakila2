<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Database/DatabaseConnection.php';

$searchResults = require __DIR__ . '/../src/Search/process_search.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php require_once __DIR__ . '/../includes/head.php'; ?>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/style_results-table.css">

</head>
<body>
    <main>
        <h1>Benvenuto nel Progetto Sakila!</h1>
        <?php require_once __DIR__ . '/../includes/check_db_connection.php'; ?>

        <?php require_once __DIR__ . '/../includes/search_form.php'; ?>

        <?php require_once __DIR__ . '/../includes/display_results.php'; ?>

        <p>Hello Sakila!</p>

    </main>
</body>
</html>