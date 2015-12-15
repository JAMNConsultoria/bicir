<?php

/**
 * @author Jasmil
 *
 */
class LocalidadeDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function LocalidadeDAO($mode) {

		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();

	}

	/**
	 * Retorna o objeto Localidade utilizando o Id.
	 * 
	 */
	public function findLocById($locId) {

		$conn = $this->pdo->getConnection($this->mode);
                $sql  = " SELECT localidadeId,regiaoId,localidadeNome,localidadeOrdem,localidadeNivel";
                $sql .= " FROM tblocalidade";
                $sql .= " WHERE localidadeId = ?";
                $sql .= " ORDER BY localidadeNome ASC";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $locId);
		$stmt->execute();


    	        foreach ($stmt as $row){
			$obj = new LocalidadeDTO();
			$obj->setLocalidadeId($row[0]);
                        $obj->setRegiaoId($row[1]);
                        $obj->setLocalidadeNome($row[2]);
                        $obj->setLocalidadeOrdem($row[3]);
                        $obj->setLocalidadeNivel($row[4]);
		}
		return $obj;
	}


	/**
	 * Retorna o objeto Localidade utilizando o Id da regiao CIR.
	 *
	 */
	public function findLocsByCirId($cirId) {

		$conn = $this->pdo->getConnection($this->mode);
                $sql  = " SELECT localidadeId,regiaoId,localidadeNome,localidadeOrdem,localidadeNivel";
                $sql .= " FROM tblocalidade";
                $sql .= " WHERE regiaoId = ?";
                $sql .= " ORDER BY localidadeNome ASC";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $cirId);
		$stmt->execute();
                $arrObj = array();

    	        foreach ($stmt as $row){
			$obj = new LocalidadeDTO();
			$obj->setLocalidadeId($row[0]);
                        $obj->setRegiaoId($row[1]);
                        $obj->setLocalidadeNome($row[2]);
                        $obj->setLocalidadeOrdem($row[3]);
                        $obj->setLocalidadeNivel($row[4]);
                        $arrObj[$row[0]] = $obj;
		}
		return $arrObj;
	}




      /**
	 * Retorna todos os Municípios ou Regiões do Brasil segundo o nível (2 - municipio ou 1-CIR).
	 * 
	 * @Return Array
	 */
	public function findLocsByNivelId($nivelId) {

		$conn = $this->pdo->getConnection($this->mode);
                $sql  = " SELECT localidadeId,regiaoId,localidadeNome,localidadeOrdem,localidadeNivel";
                $sql .= " FROM tblocalidade";
                $sql .= " WHERE localidadeNivel = ?";
                $sql .= " ORDER BY localidadeNome ASC";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $nivelId);
		$stmt->execute();
                $arrObj = array();

    	        foreach ($stmt as $row){
			$obj = new LocalidadeDTO();
			$obj->setLocalidadeId($row[0]);
                        $obj->setRegiaoId($row[1]);
                        $obj->setLocalidadeNome($row[2]);
                        $obj->setLocalidadeOrdem($row[3]);
                        $obj->setLocalidadeNivel($row[4]);
                        $arrObj[$row[0]] = $obj;
		}
		return $arrObj;
	}


        public function findLocsByArrId($arrLocId) {
		$lstLocs = implode(",",$arrLocId);
                echo $lstLocs;
		$conn = $this->pdo->getConnection($this->mode);
		$sql  = " select localidadeId,regiaoId,localidadeNome,localidadeOrdem,localidadeNivel";
		$sql .= " from tblocalidade WHERE localidadeId in ($lstLocs)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$arrObj = array();
		foreach ($stmt as $row){
			$obj = new LocalidadeDTO();
                        $obj->setLocalidadeId($row[0]);
                        $obj->setRegiaoId($row[1]);
                        $obj->setLocalidadeNome($row[2]);
                        $obj->setLocalidadeOrdem($row[3]);
                        $obj->setLocalidadeNivel($row[4]);
                        $arrObj[$row[0]] = $obj;
		}
		return $arrObj;

        }


        public function findLocsByNivelIdRegiaoId($nivelId,$regiaoId=0,$indicador) {

		$conn = $this->pdo->getConnection($this->mode);
                
                $sql  = " select l.localidadeId,l.localidadeNome,l.coordGeoJson,l.coordTipo,c.{$indicador} as grupo";
                $sql .= " from `tblocalidade` as l";
                $sql .= " inner join tbconteudoh as c";
                $sql .= " on l.localidadeId = c.localidadeId";                
                $sql .= " where localidadeNivel =?";
                if($regiaoId!=0){ //por Estado
                  $sql .= "  and regiaoId =?";                               
                }
                $sql .= " ORDER BY localidadeNome ASC";
                
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $nivelId);
                if($regiaoId!=0) { //por Estado
                    $stmt->bindValue(2, $regiaoId);
                }

		$stmt->execute();
     	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                return $result;
	}
        
        
        
        
        public function findAllUf() {

		$conn = $this->pdo->getConnection($this->mode);
                
                $sql  = " select ufId, ufNome, ufSigla, ufCentroide, ufZoom, ufOrdem  FROM tbuf";
                $sql .= " ORDER BY ufOrdem ASC";
                
		$stmt = $conn->prepare($sql);
		$stmt->execute();
                $arrResult=array();
                foreach($stmt as $row){
                    $arrResult[$row[0]]=array('ufId'=>$row[0],'ufNome'=>$row[1],'ufSigla'=>$row[2],'ufCentroide'=>$row[3],'ufZoom'=>$row[4],'ufOrdem'=>$row[5]);
                }
                return $arrResult;
	}
        


}

?>