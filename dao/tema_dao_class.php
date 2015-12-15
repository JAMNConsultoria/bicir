<?php

class TemaDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function TemaDAO($mode) {

		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();

	}

	public function findAll() {

		$conn = $this->pdo->getConnection($this->mode);
		$stmt = $conn->prepare("SELECT temaId, temaNome FROM tbtema order by temaOrdem");
		$stmt->execute();

		$temas = array();
                foreach ($stmt as $row) {
			$obj = new TemaDTO();
			$obj->setTemaId($row[0]);
			$obj->setTemaNome($row[1]);
			$temas[$row[0]] = $obj;
		}
		return $temas;
	}

        public function findTemaIndicadorById($grupoId, $idTema) {

		$conn = $this->pdo->getConnection($this->mode);
                $sql  = " SELECT id, i.indicadorId, indicadorNome, grupoId, temaId FROM tbtema_indicador as ti";
                $sql .= " inner join tbindicador as i ";
                $sql .= " on i.indicadorId = ti.indicadorId";
                $sql .= " where temaid = ? and grupoId = ?";
                $sql .= " order by indicadorNome;";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $idTema);
		$stmt->bindValue(2, $grupoId);
		$stmt->execute();

		$temas = array();

                foreach ($stmt as $row) {
			$obj = new TemaIndicadorDTO();
			$obj->setIndicadorId($row[1]);
			$obj->setIndicadorNome($row[2]);
			$obj->setGrupoId($row[3]);
			$obj->setTemaId($row[4]);
			$temas[$row[0]] = $obj;
		}
		return $temas;
	}

        public function findTemaIdByArrIndicsAndGrupoId($arrIndics,$grupoId){
            $conn = $this->pdo->getConnection($this->mode);
            $lstIndics = implode("','",$arrIndics);
            $sql = "SELECT distinct temaId from tbtema_indicador WHERE indicadorId in('{$lstIndics}') and grupoId={$grupoId}";
            //echo $sql;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $temas = array();
            foreach ($stmt as $row) {
			$temas[] = $row[0];
	     }
	     return  $temas;
        }
}
?>