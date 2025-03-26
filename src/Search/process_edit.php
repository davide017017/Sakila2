<?php
// Includi il file di connessione
require_once __DIR__ . '/../Database/DatabaseConnection.php';

// Verifica se la connessione è stata stabilita correttamente
if (!isset($db)) {
    die("Errore: La variabile di connessione al database \$db non è disponibile.");
}

// Verifica se ci sono stati errori di connessione segnalati nel file incluso
global $dbConnectionError;
if ($dbConnectionError) {
    die($dbConnectionError);
}

// Dichiara la variabile globale $message (sarà popolata da index.php)
global $message;
$message = ''; // Inizializza la variabile

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'] ?? '';
    $operation_type = $_POST['operation_type'] ?? '';

    if ($operation_type == 'add') {
        if ($table == 'actor') {
            $first_name = $_POST['first_name'] ?? '';
            $last_name = $_POST['last_name'] ?? '';

            if (!empty($first_name) && !empty($last_name)) {
                $sql = "INSERT INTO actor (first_name, last_name, last_update) VALUES (:first_name, :last_name, NOW())";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Attore <strong>" . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "</strong> aggiunto con successo.";
                    header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                    exit();
                } else {
                    $_SESSION['message'] = "Errore nell'aggiunta dell'attore <strong>" . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "</strong>: " . print_r($stmt->errorInfo(), true);
                }
            } else {
                $_SESSION['message'] = "Nome e cognome dell'attore sono obbligatori.";
            }
        } elseif ($table == 'film') {
            $title = $_POST['title'] ?? '';
            $release_year = $_POST['release_year'] ?? null;
            $rental_rate = $_POST['rental_rate'] ?? null;

            if (!empty($title)) {
                $sql = "INSERT INTO film (title, release_year, rental_rate, language_id, last_update) VALUES (:title, :release_year, :rental_rate, 1, NOW())";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':release_year', $release_year);
                $stmt->bindParam(':rental_rate', $rental_rate);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Film <strong>" . htmlspecialchars($title) . "</strong> aggiunto con successo.";
                    header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                    exit();
                } else {
                    $_SESSION['message'] = "Errore nell'aggiunta del film <strong>" . htmlspecialchars($title) . "</strong>: " . print_r($stmt->errorInfo(), true);
                }
            } else {
                $_SESSION['message'] = "Il titolo del film è obbligatorio.";
            }
        } else {
            $_SESSION['message'] = "Tabella non valida per l'aggiunta.";
        }
    } elseif ($operation_type == 'delete') {
        if ($table == 'actor') {
            $actor_id = $_POST['actor_id'] ?? null;
            if (!empty($actor_id) && is_numeric($actor_id)) {
                $sql = "DELETE FROM actor WHERE actor_id = :actor_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $_SESSION['message'] = "Attore con ID $actor_id eliminato con successo.";
                        header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                        exit();
                    } else {
                        $_SESSION['message'] = "Nessun attore trovato con ID $actor_id.";
                        header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Errore nell'eliminazione dell'attore: " . print_r($stmt->errorInfo(), true);
                }
            } else {
                $_SESSION['message'] = "ID attore non valido.";
            }
        } elseif ($table == 'film') {
            $film_id = $_POST['film_id'] ?? null;
            if (!empty($film_id) && is_numeric($film_id)) {
                $sql = "DELETE FROM film WHERE film_id = :film_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':film_id', $film_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        $_SESSION['message'] = "Film con ID $film_id eliminato con successo.";
                        header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                        exit();
                    } else {
                        $_SESSION['message'] = "Nessun film trovato con ID $film_id.";
                        header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "Errore nell'eliminazione del film: " . print_r($stmt->errorInfo(), true);
                }
            } else {
                $_SESSION['message'] = "ID film non valido.";
            }
        } else {
            $_SESSION['message'] = "Tabella non valida per l'eliminazione.";
        }
    } else {
        $_SESSION['message'] = "Operazione non valida.";
        header("Location: " . $_SERVER['PHP_SELF']); // Reindirizza alla stessa pagina
        exit();
    }
}

?>