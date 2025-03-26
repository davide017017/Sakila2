<?php

if (isset($_GET['show_all_tables'])) {
    require_once __DIR__ . '/../src/Search/showallTables.php'; 
    $searchResults = getAllSakilaTables();
}

if (!empty($searchResults)): ?>
<div class="results">
    <h2>Risultati Ricerca:</h2>
    <p>Risultati trovati: <?php echo count($searchResults);?></p>
    <table class="results-table">
        <thead>
            <tr>
                <?php if (!empty($searchResults[0])): ?>
                    <?php
                    // Determina le intestazioni delle colonne
                    $firstRow = $searchResults[0];
                    if (isset($firstRow['Tables_in_' . $db->query("SELECT DATABASE()")->fetchColumn()])) {
                        // Caso di visualizzazione di tutte le tabelle
                        echo '<th>Nome Tabella</th>';
                    } else {
                        // Caso di visualizzazione dei risultati di una query
                        foreach (array_keys($firstRow) as $column): ?>
                            <th><?php echo htmlspecialchars($column ?? ''); ?></th>
                        <?php endforeach;
                    }
                    ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($searchResults as $row): ?>
                <tr>
                    <?php
                    if (isset($row['Tables_in_' . $db->query("SELECT DATABASE()")->fetchColumn()])) {
                        // Caso di visualizzazione di tutte le tabelle
                        echo '<td>' . htmlspecialchars($row['Tables_in_' . $db->query("SELECT DATABASE()")->fetchColumn()] ?? '') . '</td>';
                    } else {
                        // Caso di visualizzazione dei risultati di una query
                        foreach ($row as $value): ?>
                            <td><?php echo htmlspecialchars($value ?? ''); ?></td>
                        <?php endforeach;
                    }
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php elseif (isset($_GET['show_table'])): ?>
    <p>Nessun risultato trovato per la tabella selezionata.</p>
<?php elseif (isset($_GET['show_all_tables'])): ?>
    <?php if (empty($searchResults)): ?>
        <p>Nessuna tabella trovata nel database.</p>
    <?php endif; ?>
<?php endif; ?>