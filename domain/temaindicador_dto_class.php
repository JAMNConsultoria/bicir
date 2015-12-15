<?php

class TemaIndicadorDTO {
	
	private $temaindicadorId;
	private $temaId;
	private $indicadorId;
	private $indicadorNome;
	private $grupoId;
	
	function __construct() {
	}
	
	public function getTemaindicadorId() {
		return $this->temaindicadorId;
	}
	
	public function setTemaindicadorId($temaindicadorId) {
		$this->temaindicadorId = $temaindicadorId;
	}
	
	public function getTemaId() {
		return $this->temaId;
	}
	
	public function setTemaId($temaId) {
		$this->temaId = $temaId;
	}
	
	public function setIndicadorId($indicadorId) {
		$this->indicadorId = $indicadorId;
	}

	public function getIndicadorId() {
		return $this->indicadorId;
	}
		
	public function getIndicadorNome() {
		return $this->indicadorNome;
	}
	
	public function setIndicadorNome($indicadorNome) {
		$this->indicadorNome = $indicadorNome;
	}
		
	public function setGrupoId($grupoId) {
		$this->grupoId = $grupoId;
	}
	public function getGrupoId() {
		return $this->grupoId;
	}
}

?>