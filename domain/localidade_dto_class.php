<?php

class LocalidadeDTO {
    private $localidadeId;
    private $regiaoId;
    private $localidadeNome;
    private $localidadeOrdem;
    private $localidadeNivel;


    function __construct() {
    }

    public function getLocalidadeId() {
        return $this->localidadeId;
    }
    
    public function setLocalidadeId($localidadeId) {
    	$this->localidadeId = $localidadeId;
    }

    public function getRegiaoId() {
        return $this->regiaoId;
    }

    public function setRegiaoId($regiaoId) {
    	$this->regiaoId = $regiaoId;
    }

    public function getLocalidadeNome() {
        return $this->localidadeNome;
    }
    
    public function setLocalidadeNome($localidadeNome) {
        $this->localidadeNome = $localidadeNome;
    }
        
    public function getLocalidadeOrdem() {
        return $this->localidadeOrdem;
    }

    public function setLocalidadeOrdem($localidadeOrdem) {
        $this->localidadeOrdem = $localidadeOrdem;
    }


    public function getLocalidadeNivel() {
        return $this->localidadeNivel;
    }

    public function setLocalidadeNivel($localidadeNivel) {
        $this->localidadeNivel = $localidadeNivel;
    }
    
}

?>