<h2>Dipendente</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="dipendente/home">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="dipendente/anagrafica">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'auto' ? 'current_page_item' : '' ?>"><a href="dipendente/auto">Parco auto</a></li>
    <li class="<?= $vd->getSottoPagina() == 'noleggi' ? 'current_page_item' : '' ?>"><a href="dipendente/noleggi">Elenco noleggi</a></li></ul>
