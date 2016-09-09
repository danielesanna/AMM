<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include 'anagrafica.php';
        break;

    case 'noleggi':
        include 'noleggi.php';
        break;

    case 'noleggi_json':
        include 'noleggi_json.php';
        break;

    case 'parco_auto':
        include 'parco_auto.php';
        break;
    
    case 'crea_veicolo':
        include 'crea_veicolo.php';
        break;
        ?>


    <?php default: ?>
        <h2>Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul>
            <li><a href="dipendente/anagrafica">Anagrafica</a></li>
            <li><a href="dipendente/auto">Parco auto</a></li>
            <li><a href="dipendente/noleggi">Noleggi</a></li>
        </ul>
        <?php
        break;
}
?>


