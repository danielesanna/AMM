<div class="input-form">
    <h2>Dati personali</h2>
    <ul>
        <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
        <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
    </ul>
</div>

<div class="input-form">
    <h3>Dati personali</h3>

    <form method="post" action="dipendente/anagrafica">
        <input type="hidden" name="cmd" value="indirizzo"/>
        <label for="via">Via o Piazza:</label>
        <input type="text" name="via" id="via" value="<?= $user->getVia() ?>"/>
        <br>
        <label for="civico">Numero Civico</label>
        <input type="text" name="civico" id="civico" value="<?= $user->getNumeroCivico() ?>"/>
        <br/>
        <label for="citta">Citt&agrave;</label>
        <input type="text" name="citta" id="citta" value="<?= $user->getCitta() ?>"/>
        <br/>
        <label for="numtel">Numero telefono</label>
        <input type="text" name="numero_tel" id="numero_tel" value="<?= $user->getNumeroTel() ?>" />
        </br>
        <input type="submit" value="Salva"/>
    </form>
</div>
<div class="input-form">
    <h3>Email</h3>

    <form method="post" action="dipendente/anagrafica">
        <input type="hidden" name="cmd" value="email"/>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email"value="<?= $user->getEmail() ?>"/>
        <br/>
        <input type="submit" value="Salva"/>
    </form>
</div>

<div class="input-form">
    <h3>Password</h3>
    <form method="post" action="dipendente/anagrafica">
        <input type="hidden" name="cmd" value="password"/>
        <label for="pass1">Nuova Password:</label>
        <input type="password" name="pass1" id="pass1"/>
        <br/>
        <label for="pass2">Conferma:</label>
        <input type="password" name="pass2" id="pass2"/>
        <br/>
        <input type="submit" value="Cambia"/>
    </form>
</div>