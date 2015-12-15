<?php

class TemaDTO {

    var $temaId;
    var $temaNome;
	var $indicadors;
	
    function  __construct() {

    }

    public function getTemaId() {
        return $this->temaId;
    }
    
    public function setTemaId($temaId) {
    	$this->temaId = $temaId;
    }
	
	public function getTemaNome() {
        return $this->temaNome;
    }
    
    public function setTemaNome($temaNome) {
        $this->temaNome = $temaNome;
    }
	
	public function getIndicadors() {
        return $this->indicadors;
    }
    
    public function setIndicadors($indicadors) {
        $this->indicadors = $indicadors;
    }
}

?>