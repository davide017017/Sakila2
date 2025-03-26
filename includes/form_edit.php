<div>
    <h2>Gestione Dati Sakila</h2>
    <div class="sakila-form-grid">
        <div>
            <h3>Aggiungi Nuovo Attore</h3>
            <form method="POST" action="">
                <div>
                    <label for="first_name">Nome:</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Nome">
                    <small>Inserisci il nome dell'attore.</small>
                </div>
                <div>
                    <label for="last_name">Cognome:</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Cognome">
                    <small>Inserisci il cognome dell'attore.</small>
                </div>
                <input type="hidden" name="table" value="actor">
                <input type="hidden" name="operation_type" value="add">
                <button type="submit">Aggiungi Attore</button>
            </form>
        </div>

        <div>
            <h3>Elimina Attore</h3>
            <form method="POST" action="">
                <div class="grid-elimina">
                    <label for="actor_id">ID Attore da Eliminare:</label>
                    <input type="number" id="actor_id" name="actor_id" min="1" placeholder="ID Attore">
                    <small>Inserisci l'ID dell'attore da eliminare.</small>
                </div>
                <input type="hidden" name="table" value="actor">
                <input type="hidden" name="operation_type" value="delete">
                <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo attore?')">Elimina Attore</button>
            </form>
        </div>

        <div>
            <h3>Aggiungi Nuovo Film</h3>
            <form method="POST" action="">
                <div class="grid-title-newfilm">
                    <label for="title">Titolo:</label>
                    <input type="text" id="title" name="title" placeholder="Aggiungi un film...">
                    <small>Inserisci il titolo del film.</small>
                </div>
                <div>
                    <label for="release_year">Anno di Rilascio:</label>
                    <input  type="number" id="release_year" name="release_year" placeholder="Anno di Rilascio">
                    <small>Inserisci l'anno di rilascio (opzionale).</small>
                </div>
                <div>
                    <label for="rental_rate">Tariffa di Noleggio:</label>
                    <input type="number" id="rental_rate" name="rental_rate" placeholder="Tariffa di Noleggio" step="0.01">
                    <small>Inserisci la tariffa di noleggio (opzionale).</small>
                </div>
                <input type="hidden" name="table" value="film">
                <input type="hidden" name="operation_type" value="add">
                <button type="submit">Aggiungi Film</button>
            </form>
        </div>

        <div>
            <h3>Elimina Film</h3>
            <form method="POST" action="">
                <div class="grid-elimina">
                    <label for="film_id">ID Film da Eliminare:</label>
                    <input type="number" id="film_id" name="film_id" min="1" placeholder="ID Film">
                    <small>Inserisci l'ID del film da eliminare.</small>
                </div>
                <input type="hidden" name="table" value="film">
                <input type="hidden" name="operation_type" value="delete">
                <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo film?')">Elimina Film</button>
            </form>
        </div>
    </div>
</div>
