<div>
    <h2>Visualizzazione Dati</h2>
    <form method="GET" action="">
        <div>
            <label for="table_name">Seleziona Tabella:</label>
            <select id="table_name" name="table_name">
                <option value="actor" class="small-option">Attori</option>
                <option value="film" class="small-option">Film</option>
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
                <option value="" class="small-option">Nessun ordine specifico</option>
                <option value="asc" class="small-option">Dall'alto (A-Z, 1-9)</option>
                <option value="desc" class="small-option">Dal basso (Z-A, 9-1)</option>
                <option value="random" class="small-option">Casuale</option>
            </select>
            <small>Scegli l'ordine di visualizzazione.</small>
        </div>

        <div>
            <label for="order_column">Ordina per colonna:</label>
            <select id="order_column" name="order_column">
                <option value="" class="small-option">-- Seleziona colonna --</option>
                <optgroup label="Attori">
                    <option value="first_name" class="small-option">Nome</option>
                    <option value="last_name" class="small-option">Cognome</option>
                    <option value="actor_id" class="small-option">ID Attore</option>
                    <option value="last_update" class="small-option">Ultimo Aggiornamento</option>
                </optgroup>
                <optgroup label="Film">
                    <option value="title" class="small-option">Titolo</option>
                    <option value="release_year" class="small-option">Anno di Rilascio</option>
                    <option value="film_id" class="small-option">ID Film</option>
                    <option value="last_update" class="small-option">Ultimo Aggiornamento</option>
                    <option value="rental_rate" class="small-option">Tariffa di Noleggio</option>
                </optgroup>
            </select>
            <small>Specifica la colonna per l'ordinamento.</small>
        </div>

        <button type="submit" name="show_table">Mostra Tabella</button>
    </form>
</div>