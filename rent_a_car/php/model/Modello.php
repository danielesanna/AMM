<?php

/**
 * Classe che descrive un modello di veicolo
 */

class Modello {
    /**
     * Identificatore unico del veicolo
     * @var int
     */
    private $id;

    /**
     * Nome della casa costruttrice
     * @var Costruttore
     */
    private $costruttore;

    /**
     * Nome del modello di auto
     * @var String
     */
    private $nome;

    /**
     * Cilindrata del veicolo
     * @var int
     */
    private $cilindrata;

    /**
     * Potenza del veicolo
     * @var int
     */
    private $potenza;
    
    /**
     * Prezzo giornaliero 
     * @var double
     */
    private $prezzo;
    
    /**
     * Restituisce un identificatore unico per il modello
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Imposta un identificatore unico per il modello
     * @param int $id
     * @return boolean true se il valore e' stato aggiornato correttamente,
     * false altrimenti
     */
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCostruttore($costruttore) {
        $this->costruttore = $costruttore;
        return true;
    }

    public function getCostruttore() {
        return $this->costruttore;
    }

    public function setCilindrata($cilindrata) {
        $intVal = filter_var($cilindrata, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->cilindrata = $intVal;
            return true;
        }
        return false;
    }

    public function getCilindrata() {
        return $this->cilindrata;
    }

    public function setPotenza($potenza) {
        $intVal = filter_var($potenza, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->potenza = $intVal;
            return true;
        }
        return false;
    }

    public function getPotenza() {
        return $this->potenza;
    }
    
    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }


}

?>
