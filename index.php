<?php

require_once __DIR__ . '/vendor/autoload.php';

use Utente\Sakila2\DatabaseContract;
use Utente\Sakila2\DatabaseFactory;
use Utente\Sakila2\DBConfig;
use Dotenv\Dotenv;

// Carica le variabili d'ambiente dal file .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Recupera le credenziali dalle variabili d'ambiente
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Crea l'oggetto DBConfig utilizzando le variabili d'ambiente
$dbConfig = new DBConfig(
    $host,
    $port,
    $dbname,
    $user,
    $password
);

$db = DatabaseFactory::create($dbConfig, DatabaseContract::TYPE_PDO);

echo "Connessione al database (tentativo)...<br>";

try {
    // Puoi aggiungere qui del codice per interagire con il database usando $pdo
    echo "Connessione al database riuscita!";
} catch (\PDOException $e) {
    die("Errore di connessione al database: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Sakila</title>
    <meta name="description" content="Pagina di benvenuto per il progetto Sakila.">
    <meta name="keywords" content="Sakila, progetto, esempio">
    <meta name="author" content="davide017">

    <link rel="stylesheet" href="/styles/style.css">

    </head>

<body>

    <main>

        
        <h1>Benvenuto nel Progetto Sakila!</h1>

        
        <?php

        // Check
        echo "<p>Hello Sakila!</p>";

        ?>

    </main>

</body>

</html>