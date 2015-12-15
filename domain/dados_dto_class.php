<?php

class DadosDTO {

    public $conteudoId ;
    public $localidadeId ;
    public $cirId ;

    function __construct($arrInd) {
        foreach($arrInd as $key => $value){
          $this->$key=$value;
        }
    }

    public function getConteudoId() {
        return $this->conteudoId;
    }

    public function setConteudoId($contudoId) {
        $this->conteudoId = $conteudoId;
    }

    public function getLocalidadeId() {
        return $this->localidadeId;
    }

    public function setLocalidadeId($localidadeId) {
        $this->localidadeId = $localidadeId;
    }

    public function getCirId() {
        return $this->cirId;
    }

    public function setCirId($cirId) {
        $this->cirId = $cirId;
    }

}

?>