<?php

require_once __DIR__ . '/../Database/DatabaseConnection.php';

if (!isset($db)) {
    die("Errore: La connessione al database non è disponibile.");
}

// Verifica errori di connessione segnalati
global $dbConnectionError;
if ($dbConnectionError) {
    die($dbConnectionError);
}

// Dichiara e inizializza la variabile globale per i messaggi
global $message;
$message = '';

// Funzione per impostare il messaggio di sessione e reindirizzare
function setMessageAndRedirect(string $message, ?string $url) {
    $_SESSION['message'] = $message;
    header("Location: " . ($url ?? $_SERVER['PHP_SELF']));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'] ?? '';
    $operationType = $_POST['operation_type'] ?? '';

    if ($operationType == 'add') {
        if ($table == 'actor') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';

            if (!empty($firstName) && !empty($lastName)) {
                $sql = "INSERT INTO actor (first_name, last_name, last_update) VALUES (:first_name, :last_name, NOW())";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':first_name', $firstName);
                $stmt->bindParam(':last_name', $lastName);

                if ($stmt->execute()) {
                    setMessageAndRedirect("Attore <strong>" . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "</strong> aggiunto con successo.", null);
                } else {
                    setMessageAndRedirect("Errore nell'aggiunta dell'attore <strong>" . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "</strong>: " . print_r($stmt->errorInfo(), true), null);
                }
            } else {
                setMessageAndRedirect("Nome e cognome dell'attore sono obbligatori.", null);
            }
        } elseif ($table == 'film') {
            $title = $_POST['title'] ?? '';
            $releaseYear = $_POST['release_year'] ?? null;
            $rentalRate = $_POST['rental_rate'] ?? null;
            $description = $_POST['description'] ?? null;

            if (!empty($title)) {
                $sql = "INSERT INTO film (title, release_year, rental_rate, language_id, description, last_update) VALUES (:title, :release_year, :rental_rate, 1, :description, NOW())";                $stmt = $db->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':release_year', $releaseYear);
                $stmt->bindParam(':rental_rate', $rentalRate);
                $stmt->bindParam(':description', $description);

                if ($stmt->execute()) {
                    setMessageAndRedirect("Film <strong>" . htmlspecialchars($title) . "</strong> aggiunto con successo.", null);
                } else {
                    setMessageAndRedirect("Errore nell'aggiunta del film <strong>" . htmlspecialchars($title) . "</strong>: " . print_r($stmt->errorInfo(), true ), null);
                }
            } else {
                setMessageAndRedirect("Il titolo del film è obbligatorio.", null);
            }
        } else {
            setMessageAndRedirect("Tabella non valida per l'aggiunta.", null);
        }
    } elseif ($operationType == 'delete') {
        if ($table == 'actor') {
            $actorId = $_POST['actor_id'] ?? null;
            if (!empty($actorId) && is_numeric($actorId)) {
                $sql = "DELETE FROM actor WHERE actor_id = :actor_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':actor_id', $actorId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        setMessageAndRedirect("Attore con ID $actorId eliminato con successo.", null);
                    } else {
                        setMessageAndRedirect("Nessun attore trovato con ID $actorId.", null);
                    }
                } else {
                    setMessageAndRedirect("Errore nell'eliminazione dell'attore: " . print_r($stmt->errorInfo(), true), null);
                }
            } else {
                setMessageAndRedirect("ID attore non valido.", null);
            }
        } elseif ($table == 'film') {
            $filmId = $_POST['film_id'] ?? null;
            if (!empty($filmId) && is_numeric($filmId)) {
                $sql = "DELETE FROM film WHERE film_id = :film_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':film_id', $filmId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        setMessageAndRedirect("Film con ID $filmId eliminato con successo.", null);
                    } else {
                        setMessageAndRedirect("Nessun film trovato con ID $filmId.", null);
                    }
                } else {
                    setMessageAndRedirect("Errore nell'eliminazione del film: " . print_r($stmt->errorInfo(), true ), null);
                }
            } else {
                setMessageAndRedirect("ID film non valido.", null);
            }
        } else {
            setMessageAndRedirect("Tabella non valida per l'eliminazione.", null);
        }
    } else {
        setMessageAndRedirect("Operazione non valida.", null);
    }
}

?>