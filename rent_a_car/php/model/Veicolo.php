<?php

/**
 * Classe che rappresenta un veicolo
 *
 * @author Daniele
 */
class Veicolo {

    /**
     * Modello del veicolo
     * @var Modello
     */
    private $modello;

    /**
     * Anno di immatricolazione
     * @var int
     */
    private $anno;

    /**
     * Flag che memorizza se la macchina è prenotabile
     * (non attualmente prenotata)
     * @var boolean
     */
    private $prenotabile;

    /**
     * Targa del veicolo
     * @var String 
     */
    private $targa;

    /**
     * Costruttore
     */
    public function __costruct() {
        
    }

    /**
     * Restituisce un identificatore unico per il veicolo
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Imposta un identificatore unico per il veicolo
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

    public function setAnno($anno) {
        $intVal = filter_var($anno, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            if ($intVal > 1930 && $intVal <= date("Y")) {
                $this->anno = $intVal;
                return true;
            }
        }
        return false;
    }

    public function getAnno() {
        return $this->anno;
    }

    public function setPrenotabile($flag) {
        $bool = filter_var($flag, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if (isset($bool)) {
            $this->prenotabile = $bool;
            return true;
        }
        return false;
    }

    public function isPrenotabile() {
        return $this->prenotabile;
    }

    public function setModello($modello) {
        $this->modello = $modello;
    }

    public function getModello() {
        return $this->modello;
    }

    public function getTarga() {
        return $this->targa;
    }

    public function setTarga($targa) {
        $this->targa = $targa;
    }

}

?>
