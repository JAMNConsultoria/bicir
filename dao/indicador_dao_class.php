<?php

/**
 * @author Jasmil A. Oliveira
 *
 */
class IndicadorDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function IndicadorDAO($mode) {
		
		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();
		
	}
	
	/**
	 * Retorna o objeto Painel utilizando o Id.
	 * 
	 */
	public function findIndicadorById($indId) {
		
		$conn = $this->pdo->getConnection($this->mode);
		$sql  = " select indicadorId,indicadorNome";
		$sql .= " from tbindicador WHERE indicadorId = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $indId);
		$stmt->execute();
		$arrObj = array();
		foreach ($stmt as $row){
			$obj = new IndicadorDTO();
			$obj->setIndicadorId($row[0]);
			$obj->setIndicadorNome($row[1]);
		}
		return $obj;
	}

      	/**
	 * Retorna o objeto Indicadores segundo os codigos(array) de indicadores passados.
	 *
	 */
        public function findIndicadoresByArrId($arrIndId) {
		$lstIndicadores = "'".implode("','",$arrIndId)."'";
                //echo $lstIndicadores;
		$conn = $this->pdo->getConnection($this->mode);
		$sql  = " select indicadorId,indicadorNome";
		$sql .= " from tbindicador WHERE indicadorId in ($lstIndicadores)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$arrObj = array();
		foreach ($stmt as $row){
			$obj = new IndicadorDTO();
			$obj->setIndicadorId($row[0]);
			$obj->setIndicadorNome($row[1]);
                        $arrObj[$row[0]] = $obj;
		}
		return $arrObj;
	}
        /**
	 * Retorna um array de Indicadores com codigo e descriчуo segundo os codigos(array) de indicadores passados.
	 *
	 */
        public function findDescIndicadoresByArrId($arrIndId) {
		$lstIndicadores = "'".implode("','",$arrIndId)."'";
                //echo $lstIndicadores;
		$conn = $this->pdo->getConnection($this->mode);
		$sql  = " select indicadorId,indicadorNome";
		$sql .= " from tbindicador WHERE indicadorId in ($lstIndicadores)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$arrDescInd = array();
		foreach ($stmt as $row){
                        $arrDescInd[$row[0]] = $row[1];
		}
		return $arrDescInd;
	}

       	
}

?>