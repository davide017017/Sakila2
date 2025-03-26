<?php
require_once __DIR__ . '/../Database/DatabaseConnection.php';

$searchResults = []; // Inizializza l'array per i risultati della ricerca
$tableName = null;

// Verifica se è stato inviato il form per mostrare la tabella
if (isset($_GET['show_table']) && isset($_GET['table_name'])) {
    $tableName = $_GET['table_name'];
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $orderByDirection = isset($_GET['order_by']) ? $_GET['order_by'] : '';
    $orderByColumn = isset($_GET['order_column']) ? $_GET['order_column'] : ''; // Recupera la colonna per l'ordinamento

    $limit = max(1, $limit); // Assicura che il limite sia almeno 1

    // Sanitizzazione dell'input per prevenire SQL Injection
    $allowedTables = ['actor', 'film']; // Definisci le tabelle consentite
    if (in_array($tableName, $allowedTables)) {
        if (isset($db)) {
            try {
                $sql = "SELECT * FROM " . $tableName;

                // Aggiungi l'ordinamento se specificato
                if (!empty($orderByColumn)) {
                    // **Importante:** Dovresti validare $orderByColumn contro una lista di colonne consentite
                    $sql .= " ORDER BY " . htmlspecialchars($orderByColumn);
                    if ($orderByDirection === 'asc') {
                        $sql .= " ASC";
                    } elseif ($orderByDirection === 'desc') {
                        $sql .= " DESC";
                    }
                } elseif ($orderByDirection === 'random') {
                    $sql .= " ORDER BY RAND()"; // Ordinamento casuale (specifico per MySQL)
                    // Nota: Per altri database (es. PostgreSQL, SQLite), usa "ORDER BY RANDOM()"
                }

                // Limita il numero di risultati
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

// Restituisce l'array dei risultati della ricerca
return $searchResults;
?>