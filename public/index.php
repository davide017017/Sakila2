<?php
$sessionPath = __DIR__ . '/../sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}
session_save_path($sessionPath);
session_start();

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Database/DatabaseConnection.php';

$searchResults = require __DIR__ . '/../src/Search/process_search.php';

$message = '';

// Verifica se c'è un messaggio nella sessione
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Rimuovi il messaggio dalla sessione
}
// Verifica se il form è stato inviato e se è presente l'operation_type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['operation_type'])) {
    include __DIR__ . '/../src/Search/process_edit.php';
    // La variabile $message potrebbe essere sovrascritta da process_edit.php (anche se ora reindirizza)
    // Potresti voler gestire la logica del messaggio in modo più centralizzato.
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