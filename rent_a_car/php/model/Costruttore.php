<?php

/**
 * Classe che descrive un costruttore di veicoli
 */
class Costruttore {
    
    private $id;
    
    private $nome;
    
    public function setId($id){
        $this->id=$id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setNome($nome){
        $this->nome=$nome;
    }
    
    public function getNome(){
        return $this->nome;
    }
}

?>
