<?php

namespace Utente\Sakila2\Database ;

class MyPDO extends \PDO implements DatabaseContract {

    // Costruttore della classe MyPDO
    public function __construct(\Utente\Sakila2\Database\DBConfig $dBConfig){

        // Costruisce la stringa DSN (Data Source Name) per la connessione
        $dsn = $this->getDsn($dBConfig->host, $dBConfig->port, $dBConfig->dbName);
        // Recupera l'username dalla configurazione
        $username = $dBConfig->user;
        // Recupera la password dalla configurazione
        $password = $dBConfig->password;
        // Inizializza un array vuoto per le opzioni PDO
        $options = [];

        try {
            // Chiama il costruttore della classe genitore PDO per stabilire la connessione
            parent::__construct($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            // Logga l'errore in un file (assicurati che la directory esista e abbia i permessi di scrittura)
            file_put_contents('F:\code\SAKILA_2\pdo_error.log', $e->getMessage() . "\n", FILE_APPEND);
            throw $e; // Rilancia l'eccezione per farla gestire dal blocco catch in DatabaseFactory
        }
    }

    // Metodo privato per generare la stringa DSN
    private function getDsn(string $host, string $port,  string $dbName) {
        return "mysql:" .
            "host={$host};" .
            "port={$port};" .
            "dbname={$dbName};" .
            "charset=utf8mb4"; // Specifica il charset
    }

}