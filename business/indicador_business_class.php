<?php
require_once("../business/base_business_class.php");
require_once("../dao/mysqldaofactory_class.php");
require_once("../domain/indicador_dto_class.php");
require_once("../dao/indicador_dao_class.php");


class IndicadorBusiness extends BaseBusiness {

	public function findIndicadorById($indId) {
		$oIdao = new IndicadorDAO(1);
		return $oIdao->findIndicadorById($indId);
	}

        public function findIndicadoresByArrId($arrIndId) {
		$oIdao = new IndicadorDAO(1);
		return $oIdao->findIndicadoresByArrId($arrIndId);
	}
        public function findDescIndicadoresByArrId($arrIndId){
        	$oIdao = new IndicadorDAO(1);
		return $oIdao->findDescIndicadoresByArrId($arrIndId);
        }
}
?>