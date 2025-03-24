<?php

namespace Utente\Sakila2 ;

class MyPDO extends \PDO implements DatabaseContract {

    // Costruttore della classe MyPDO
    public function __construct(\Utente\Sakila2\DBConfig $dBConfig){

        // Costruisce la stringa DSN per la connessione
        $dsn = $this->getDsn($dBConfig->host, $dBConfig->port, $dBConfig->DBName);
        // Recupera l'username dalla configurazione
        $username = $dBConfig->user;
        // Recupera la password dalla configurazione
        $password = $dBConfig->password;
        // Inizializza un array vuoto per le opzioni PDO
        $options = [];

        // Chiama il costruttore della classe genitore PDO per stabilire la connessione
        parent::__construct($dsn, $username, $password, $options);

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