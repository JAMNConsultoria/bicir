<?php
require_once("../business/base_business_class.php");
require_once("../dao/mysqldaofactory_class.php");
require_once("../domain/dados_dto_class.php");
require_once("../dao/dados_dao_class.php");


class DadosBusiness extends BaseBusiness {

	public function findDadosByLocId($locId,$arrIndics) {
		$oIdao = new DadosDAO(1);
		return $oIdao->findDadosByLocId($locId,$arrIndics);
	}

        public function findDadosByLocsAndIndics($arrLocs,$arrIndics,$formato) {
 		$oIdao = new DadosDAO(1);
		return $oIdao->findDadosByLocsAndIndics($arrLocs,$arrIndics,$formato);
	}

       	public function findTotaisCirByUfId($ufId) {
		$oIdao = new DadosDAO(1);
		return $oIdao->findTotaisCirByUfId($ufId);
	}

}
        
?>