<?php if (!empty($searchResults)): ?>
<div class="results">

    <h2>Risultati Ricerca:</h2>
    <p>Risultati trovati: <?php echo count($searchResults);?></p>

    <table class="results-table"> 
        <thead>
            <tr>
                <?php if (!empty($searchResults[0])): ?>
                    <?php foreach (array_keys($searchResults[0]) as $column): ?>
                        <th><?php echo htmlspecialchars($column ?? ''); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($searchResults as $row): ?>
                <tr>
                    <?php foreach ($row as $value): ?>
                        <td><?php echo htmlspecialchars($value ?? ''); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>   
<?php elseif (isset($_GET['show_table'])): ?>
    <p>Nessun risultato trovato per la tabella selezionata.</p>
<?php endif; ?>