<?php
require_once __DIR__ . '/../Database/DatabaseConnection.php';

$searchResults = []; // Usa $searchResults invece di $allTables

// Verifica se è stato inviato un parametro GET per mostrare le tabelle
if (isset($_GET['show_all_tables'])) { // Cambia il nome del parametro GET
    // Chiama la funzione per ottenere tutte le tabelle dal database corrente
    function getAllSakilaTables() {
        global $db; // Assumiamo che la tua connessione PDO sia in una variabile globale $db

        try {
            // Ottieni il nome del database corrente
            $stmtDbName = $db->query("SELECT DATABASE()");
            $databaseName = $stmtDbName->fetchColumn();

            if ($databaseName) {
                // Utilizza il nome del database corrente nella query SHOW TABLES
                $sql = "SHOW TABLES FROM " . $databaseName;

                // Prepara ed esegui la query
                $stmt = $db->prepare($sql);
                $stmt->execute();

                // Recupera tutti i risultati come array associativo (adattato)
                $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
                $searchResults = [];
                foreach ($tables as $tableName) {
                    $searchResults[] = ['Tables_in_' . $databaseName => $tableName]; // Adatta la struttura per la tabella HTML
                }
                return $searchResults;

            } else {
                return []; // Restituisci un array vuoto se non si riesce a ottenere il nome del database
            }

        } catch (PDOException $e) {
            // Gestisci eventuali errori di connessione o query
            die("Errore durante la visualizzazione delle tabelle: " . $e->getMessage());
        }
    }

    $searchResults = getAllSakilaTables(); // Assegna il risultato a $searchResults
}

// Restituisce l'array contenente i nomi di tutte le tabelle (ora in $searchResults)
return $searchResults;
?>