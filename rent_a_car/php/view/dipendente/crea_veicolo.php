<div class="input-form">
    <h3>Crea veicolo</h3>
    <form method="post" action="dipendente/crea_veicolo">
        <input type="hidden" name="cmd" value="nuovo_veicolo"/>
        <label for="modello">Modello</label>
        <select name="modello" id="modello">
            <?php foreach ($modelli as $modello) { ?>
                <option value="<?= $modello->getId() ?>" >
                    <?= $modello->getCostruttore()->getNome() . " " . $modello->getNome() . " - " . 
                    $modello->getCilindrata() . " cc<sup>3</sup> " . $modello->getPotenza() . " cv"
                    ?></option>
            <?php } ?>
        </select>
        <br/>
        <label for="anno">Anno</label>
        <input type="anno" name="anno" id="anno"/>
        <br/>
        <label for="targa">Targa</label>
        <input type="targa" name="targa" id="targa"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="veicolo_nuovo">Salva</button>
            <button type="submit" name="cmd" value="a_annulla">Annulla</button>
        </div>
    </form>
</div>