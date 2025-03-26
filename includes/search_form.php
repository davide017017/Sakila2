<div>
    <h2>Visualizzazione Dati</h2>
    <form method="GET" action="">
        <div>
            <label for="table_name">Seleziona Tabella:</label>
            <select id="table_name" name="table_name">
                <option value="actor">Attori</option>
                <option value="film">Film</option>
            </select>
            <small>Seleziona la tabella di dati.</small>
        </div>

        <div>
            <label for="limit">Numero di Risultati:</label>
            <input type="number" id="limit" name="limit" min="1" value="5">
            <small>Inserisci il numero massimo di risultati.</small>
        </div>

        <div>
            <label for="order_by">Ordina i risultati:</label>
            <select id="order_by" name="order_by">
                <option value="">Nessun ordine specifico</option>
                <option value="asc">Dall'alto (A-Z, 1-9)</option>
                <option value="desc">Dal basso (Z-A, 9-1)</option>
                <option value="random">Casuale</option>
            </select>
            <small>Scegli l'ordine di visualizzazione.</small>
        </div>

        <div>
            <label for="order_column">Ordina per colonna:</label>
            <select id="order_column" name="order_column">
                <option value="">-- Seleziona colonna --</option>
                <optgroup label="Attori">
                    <option value="first_name">Nome</option>
                    <option value="last_name">Cognome</option>
                    <option value="actor_id">ID Attore</option>
                    <option value="last_update">Ultimo Aggiornamento</option>
                </optgroup>
                <optgroup label="Film">
                    <option value="title">Titolo</option>
                    <option value="release_year">Anno di Rilascio</option>
                    <option value="film_id">ID Film</option>
                    <option value="last_update">Ultimo Aggiornamento</option>
                    <option value="rental_rate">Tariffa di Noleggio</option>
                </optgroup>
            </select>
            <small>Specifica la colonna per l'ordinamento.</small>
        </div>

        <button type="submit" name="show_table">Mostra Tabella Filtrata </button>
        <button class="singlebutton" type="submit" name="show_all_tables">Mostra Tutte le Tabelle</button>
    </form>
</div>