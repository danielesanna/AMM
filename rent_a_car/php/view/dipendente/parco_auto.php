
<h2>Parco auto</h2>
<table>
    <tr>
        <th>Costruttore</th>
        <th>Modello</th>
        <th>Targa</th>
        <th>Anno imm.</th>
        <th>Potenza</th>
        <th>Cilindrata</th>
        <th>Prezzo</th>
        <th>Cancella</th>
    </tr>
    <?
    foreach($veicoli as $veicolo){
    ?>
    <tr>
        <td><?= $veicolo->getModello()->getCostruttore()->getNome()?></td>
        <td><?= $veicolo->getModello()->getNome() ?></td>
        <td><?= $veicolo->getTarga() ?></td>
        <td><?= $veicolo->getAnno()?></td>
        <td><?= $veicolo->getModello()->getPotenza() . " cv"?></td>
        <td><?= $veicolo->getModello()->getCilindrata() . " cm<sup>3</sup>"?></td>
        <td><?= $veicolo->getModello()->getPrezzo() ?> €/giorno</td>
        <td><a href="dipendente/auto?cmd=cancella_veicolo&veicolo=<?= $veicolo->getId()?>" title="Elimina il veicolo">
            <img src="../img/cancella.bmp" alt="Elimina"></a>
    </tr>
    <? } ?>
</table>

<div class="input-form">

    <form method="post" action="dipendente/auto">
        <button type="submit" name="cmd" value="new_veicolo">Crea Veicolo</button>
    </form>

</div>