<?php
if ($dbConnectionError) {
    echo '<div class="db-connection-status error">';
    echo '<span class="icon">&#10006;</span> Errore di connessione al database: ' . htmlspecialchars($dbConnectionError);
    echo '</div>';
} else {
    echo '<div class="db-connection-status success">';
    echo '<span class="icon">&#10004;</span> Connessione al database riuscita!';
    echo '</div>';
}
?>