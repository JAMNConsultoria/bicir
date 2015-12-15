<?php
require_once("../business/base_business_class.php");
require_once("../domain/tema_dto_class.php");
require_once("../domain/temaindicador_dto_class.php");
require_once("../dao/tema_dao_class.php");

class TemaBusiness extends BaseBusiness {

	public function loadGrupoTemaIndicador($idGrupo) {
		$oTdao = new TemaDAO(1);

		// Retorna todos os temas
		$temas = $oTdao->findAll();
		foreach($temas as $key => $tema) {

			// Retorna uma lista de Indicadores por Tema
			$temaIndicadors = $oTdao->findTemaIndicadorById($idGrupo, $tema->getTemaId());

			// Seta os indicadores no tema
			$tema->setIndicadors($temaIndicadors);
		}

		return $temas;
	}
        public function findTemaIdByArrIndicsAndGrupoId($arrIndics,$grupoId){
            $oTdao = new TemaDAO(1);
	    return $oTdao->findTemaIdByArrIndicsAndGrupoId($arrIndics,$grupoId);
        }

}
?>