<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'noleggi':
        include_once 'noleggi.php';
        break;
    
    case 'parco_auto':
        include_once 'parco_auto.php';
        break;
    
    case 'prenotazione':
        include_once 'prenotazione.php';
        break;

    default:
        ?>
        <h2>Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul>
            <li><a href="cliente/anagrafica">Anagrafica</a></li>
            <li><a href="cliente/noleggi">Elenco Noleggi</a></li>
            <li><a href="cliente/veicoli">Veicoli</a></li>            
        </ul>
        <?php
        break;
}
?>


