<h2>Ricerca noleggi</h2>
<div class="error">
    <div>
        <ul><li>Testo</li></ul>
    </div>
</div>
<div class="input-form">
    <h3>Filtro</h3>
    <form method="get" action="dipendente/noleggi">
        <label for="veicolo">Veicolo</label>
        <select name="veicolo" id="veicolo">
            <option value="">Qualsiasi</option>
            <?php foreach ($veicoli as $veicolo) { ?>
                <option value="<?= $veicolo->getId() ?>" ><?= $veicolo->getModello()->getNome() . " " . $veicolo->getTarga() ?></option>
            <?php } ?>
        </select>
        <br/>
        <label for="cliente">Cliente</label>
        <select name="cliente" id="cliente">
            <option value="">Qualsiasi</option>
            <?php foreach ($clienti as $cliente) { ?>
                <option value="<?= $cliente->getId() ?>" ><? echo $cliente->getNome() . " " . $cliente->getCognome()?></option>
            <?php } ?>
        </select>
        <br/>
        <label for="datainizio">Data inizio</label>
        <input name="datainizio" id="datainizio" type="text"/>
        <br/>
        <label for="datafine">Data fine</label>
        <input name="datafine" id="datafine" type="text"/>
        <br/>
        <button id="filtra" type="submit" name="cmd">Cerca</button>
    </form>
</div>



<h3>Elenco Noleggi</h3>

<p id="nessuno">Nessun noleggio trovato</p>

<table id="tabella_noleggi">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Veicolo</th>
            <th>Targa</th>
            <th>Data inizio</th>
            <th>Data fine</th>
            <th>Costo</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>