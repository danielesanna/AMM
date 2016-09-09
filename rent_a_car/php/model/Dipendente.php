<?php

include_once 'User.php';

/**
 * Classe che rappresenta un Dipendente
 */
class Dipendente extends User {

    /**
     * Costruttore
     */
    public function __construct() {
        // richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Dipendente);
    }

}

?>
