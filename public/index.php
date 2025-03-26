<?php
// Configurazione del percorso delle sessioni
$sessionPath = __DIR__ . '/../sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}
session_save_path($sessionPath);
session_start();

// Inclusione dell'autoloader di Composer (per caricare le librerie esterne)
require __DIR__ . '/../vendor/autoload.php';

// Inclusione del file di connessione al database
require_once __DIR__ . '/../src/Database/DatabaseConnection.php';

// Inclusione del file per la gestione della ricerca
$searchResults = require __DIR__ . '/../src/Search/process_search.php';

$message = '';

// Recupera il messaggio dalla sessione e lo rimuove
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Gestisci l'invio del form per operazioni di modifica (aggiunta, eliminazione)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['operation_type'])) {
    include __DIR__ . '/../src/Search/process_edit.php';
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php require_once __DIR__ . '/../includes/head.php'; ?>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <main>
        <h1>Benvenuto nel Progetto Sakila!</h1>
        <?php require_once __DIR__ . '/../includes/check_db_connection.php'; ?>

        <div class="form-section">
            <?php require_once __DIR__ . '/../includes/search_form.php'; ?>
            <?php include __DIR__ . '/../includes/form_edit.php'; ?>
        </div>

        <?php if ($message) {echo "<p>" . $message . "</p>";}?>
        <?php require_once __DIR__ . '/../includes/display_results.php'; ?>
        <p>Hello Sakila!</p>
    </main>
</body>
</html>