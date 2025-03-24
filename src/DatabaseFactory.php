<?php

namespace Utente\Sakila2 ;

use Utente\Sakila2\DatabaseContract;
use Exception;
use PDO;
use PDOException;

class DatabaseFactory {

    // Metodo statico per creare una connessione al database
    public static function create(\Utente\Sakila2\DBConfig $dbconfig, string $type = DatabaseContract::TYPE_PDO): ?DatabaseContract {
        if ($type === DatabaseContract::TYPE_PDO) {
            // Crea una connessione PDO
            return self::CreateWithPDO($dbconfig);
        } else {
            // Lancia un'eccezione se il tipo non è supportato
            throw new Exception("Tipo di database '{$type}' non supportato: {$type}");
        }
    }
    // Metodo privato statico per creare una connessione PDO
    private static function CreateWithPDO(\Utente\Sakila2\DBConfig $dbconfig){
        try {
            // Crea una nuova istanza di MyPDO
            $pdo = new MyPDO($dbconfig);
            // Imposta gli attributi per la gestione degli errori
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Restituisce l'oggetto PDO
            return $pdo;
        } catch (PDOException $e) {
            // Lancia un'eccezione in caso di fallimento della connessione
            throw new Exception("Connessione al database fallita:  {$e->getMessage()}");
        }
    }
}

?>