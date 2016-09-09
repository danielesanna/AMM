<?php

/**
 * Classe che descrive il noleggio di un veicolo
 *
 */

class Noleggio {
    
    private $id;
    
    private $cliente;
    
    private $veicolo;
    
    private $datainizio;
    
    private $datafine;
    
    private $costo;
   
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($idCliente) {
        $this->cliente = $idCliente;
    }

    public function getVeicolo() {
        return $this->veicolo;
    }

    public function setVeicolo($idVeicolo) {
        $this->veicolo = $idVeicolo;
    }

    public function getDatainizio() {
        return $this->datainizio;
    }

    public function setDatainizio($datainizio) {
        $this->datainizio = $datainizio;
    }

    public function getDatafine() {
        return $this->datafine;
    }

    public function setDatafine($datafine) {
        $this->datafine = $datafine;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }



    
}

?>
