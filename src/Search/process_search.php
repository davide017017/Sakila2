<?php
// src/Search/process_search.php

require_once __DIR__ . '/../Database/DatabaseConnection.php';

$searchResults = []; // Array per memorizzare i risultati della ricerca
$tableName = null;

// Verifica se è stato cliccato il pulsante "Mostra Tabella"
if (isset($_GET['show_table']) && isset($_GET['table_name'])) {
    $tableName = $_GET['table_name'];
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $orderByDirection = isset($_GET['order_by']) ? $_GET['order_by'] : '';
    $orderByColumn = isset($_GET['order_column']) ? $_GET['order_column'] : ''; // Recupera la colonna selezionata

    $limit = max(1, $limit); // Assicurati che $limit sia almeno 1
    
    // **IMPORTANTE: SANITIZE L'INPUT PER PREVENIRE SQL INJECTION**
    $allowedTables = ['actor', 'film']; // Aggiungi qui le tabelle che vuoi permettere di visualizzare
    if (in_array($tableName, $allowedTables)) {
        if (isset($db)) {
            try {
                $sql = "SELECT * FROM " . $tableName;

                if (!empty($orderByColumn)) {
                    $sql .= " ORDER BY " . htmlspecialchars($orderByColumn); // Usa la colonna selezionata
                    if ($orderByDirection === 'asc') {
                        $sql .= " ASC";
                    } elseif ($orderByDirection === 'desc') {
                        $sql .= " DESC";
                    }
                } elseif ($orderByDirection === 'random') {
                    $sql .= " ORDER BY RAND()"; // Per MySQL
                    // Per altri database come PostgreSQL o SQLite, potresti usare "ORDER BY RANDOM()"
                }

                $sql .= " LIMIT " . $limit;

                $stmt = $db->query($sql);
                $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Errore durante il recupero della tabella " . htmlspecialchars($tableName) . ": " . $e->getMessage();
            }
        } else {
            echo "Errore: Connessione al database non disponibile.";
        }
    } else {
        echo "Errore: Tabella non valida selezionata.";
    }
}

// Restituisci i risultati
return $searchResults;
?>