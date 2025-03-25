<?php

$dbConnectionError = null; // Variabile per memorizzare eventuali errori di connessione

// Funzione per caricare le variabili d'ambiente da un file .env
function loadEnv($filePath) {
    // Verifica se il file specificato nel percorso esiste
    if (!file_exists($filePath)) {
        return; // Se il file non esiste, la funzione termina (potresti anche lanciare un'eccezione qui)
    }

    // Legge il contenuto del file riga per riga in un array
        // FILE_IGNORE_NEW_LINES: Rimuove il carattere di newline da ogni riga
        // FILE_SKIP_EMPTY_LINES: Salta le righe vuote
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Itera su ogni riga letta dal file
    foreach ($lines as $line) {
        // Verifica se la riga, dopo aver rimosso gli spazi bianchi all'inizio e alla fine, inizia con un '#' (simbolo di commento)
        if (strpos(trim($line), '#') === 0) {
            continue; // Se è un commento, passa alla riga successiva
        }

        // Verifica se la riga contiene il simbolo '=', che separa il nome della variabile dal suo valore
        if (strpos($line, '=') !== false) {
            // Divide la riga in due parti usando '=' come delimitatore
            // Il terzo parametro '2' limita la divisione a una sola occorrenza del '=', utile se il valore contiene altri '='
            list($name, $value) = explode('=', $line, 2);

            // Rimuove gli spazi bianchi all'inizio e alla fine del nome della variabile
            $name = trim($name);

            // Rimuove gli spazi bianchi all'inizio e alla fine del valore della variabile
            $value = trim($value);

            // Verifica se una variabile d'ambiente con questo nome non è già stata definita nell'array $_ENV
            if (!array_key_exists($name, $_ENV)) {
                // Imposta la variabile d'ambiente nell'array superglobale $_ENV
                $_ENV[$name] = $value;

                // Imposta la variabile d'ambiente anche per l'utilizzo con la funzione getenv()
                putenv(sprintf('%s=%s', $name, $value));
            }
        }
    }
}

// Specifica il percorso del tuo file .env
$envFilePath = __DIR__ . '/../VariabiliAmbiente/.env';

// Carica le variabili d'ambiente
loadEnv($envFilePath);

// Recupera le credenziali dalle variabili d'ambiente
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Importa le altre classi necessarie
use Utente\Sakila2\Database\DatabaseContract;
use Utente\Sakila2\Database\DatabaseFactory;
use Utente\Sakila2\Database\DBConfig;

// Crea l'oggetto DBConfig utilizzando le variabili d'ambiente
$dbConfig = new DBConfig(
    $host,
    $port,
    $dbname,
    $user,
    $password
);

try {
    $db = DatabaseFactory::create($dbConfig, DatabaseContract::TYPE_PDO);
    // Connessione riuscita, non mostriamo messaggi qui
} catch (\PDOException $e) {
    $dbConnectionError = "Errore di connessione al database: " . $e->getMessage();
}

// Se vuoi poter usare $db in index.php, potresti restituirlo
if (!$dbConnectionError) {
    return $db;
}

?>