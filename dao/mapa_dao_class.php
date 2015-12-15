<?php

/**
 * @author Jasmil
 *
 */
class MapaDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function MapaDAO($mode) {

		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();

	}

	/**
	 * Retorna um array com informações sobre as cirs de um determinado grupo socioeconomico e sua UF
	 * 
	 */
	public function findCirsByGrupoSocioAndUf($grupoSocio,$ufId) {

		$conn = $this->pdo->getConnection($this->mode);
                $sql  = "  SELECT distinct localidadeId,nome_cir,cod_cir,cod_uf,nome_uf";
                $sql .= " FROM tbconteudoh";
                $sql .= " WHERE grupo_socio = ? and cod_uf=?";
                $sql .= " ORDER BY nome_cir ASC";
                #echo $sql;
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $grupoSocio);
                $stmt->bindValue(2, $ufId);
		$stmt->execute();

                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
	}
        
}

?>