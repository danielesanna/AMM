<h2>Elenco noleggi</h2>
<table id="tabella_noleggi">
    <thead>
        <tr>
            <th>Veicolo</th>
            <th>Targa</th>
            <th>Data inizio</th>
            <th>Data fine</th>
            <th>Costo</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($noleggi as $noleggio) { ?>
        <tr>
            <td><?= $noleggio->getVeicolo()->getModello()->getCostruttore()->getNome() . " " . $noleggio->getVeicolo()->getModello()->getNome() ?></td>
            <td><?= $noleggio->getVeicolo()->getTarga() ?></td>
            <td><?= $noleggio->getDatainizio() ?></td>
            <td><?= $noleggio->getDatafine() ?></td>
            <td><?= $noleggio->getCosto() ?> €</td>
        </tr>                
        <? } ?>

    </tbody>
</table>