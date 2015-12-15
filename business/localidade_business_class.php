<?php
require_once("../business/base_business_class.php");
require_once("../dao/mysqldaofactory_class.php");
require_once("../domain/localidade_dto_class.php");
require_once("../dao/localidade_dao_class.php");


class LocalidadeBusiness extends BaseBusiness {

	public function findLocById($locId) {
		$oLdao = new LocalidadeDAO(1);
		return $oLdao->findLocById($locId);
	}

        public function findLocsByCirId($cirId) {
		$oLdao = new LocalidadeDAO(1);
		return $oLdao->findLocsByCirId($cirId);
	}

        public function findLocsByNivelId($nivelId) {
		$oLdao = new LocalidadeDAO(1);
		return $oLdao->findLocsByNivelId($nivelId);
	}

        public function findLocsByArrId($arrLocId) {
		$oIdao = new LocalidadeDAO(1);
		return $oIdao->findLocsByArrId($arrLocId);
	}
        
        public function findLocsByNivelIdRegiaoId($nivelId,$regiaoId) {
		$oLdao = new LocalidadeDAO(1);
		return $oLdao->findLocsByNivelIdRegiaoId($nivelId,$regiaoId);
	}
        
       public function findAllUf() {
           	$oLdao = new LocalidadeDAO(1);
                return $oLdao->findAllUf();
       }
        
        public function geraMapaGeoJSon($nivelId,$regiaoId,$indicador){
                       
            $oLdao = new LocalidadeDAO(1);
            $objMapa = $oLdao->findLocsByNivelIdRegiaoId($nivelId, $regiaoId,$indicador);
            $ini ='{"type": "FeatureCollection","features":[';
            $fim =']}';
            $arrTroca=array("]]]","[[[");
            foreach($objMapa as $indice => $arrCampos){
                $locId=$arrCampos['localidadeId'];
                $locNome =trim($arrCampos['localidadeNome']);
                $coordGeoJson =$arrCampos['coordGeoJson'];
                $tipo =trim($arrCampos['coordTipo']);
                $grupo=trim($arrCampos['grupo']);
                if($tipo=='MultiPolygon'){
                    $tipoc='Polygon';
                    $coordGeoJson = str_replace("[[[[","",$coordGeoJson);
                    $coordGeoJson = str_replace("]]]]","",$coordGeoJson);
                    $arrCoordGeoJson = explode("]]],[[[",$coordGeoJson);
                    for($i=0;$i < count($arrCoordGeoJson);$i++){
                        $coord = ($c==0?"[[[".$arrCoordGeoJson[$i]."]]]":($c==count($arrCoordGeoJson)? "[[[".$arrCoordGeoJson[$i]:"[[[".$arrCoordGeoJson[$i]."]]"));
                        $conteudo[] ='{ "type": "Feature", "properties": { "grp":'.$grupo.',"nome":"'.$locNome.'", "cod": "'.$locId.'" }, "geometry": { "type": "'.$tipoc.'", "coordinates":'.$coord.'}}';
                    }
                }else{
                    $conteudo[] ='{ "type": "Feature", "properties": { "grp":'.$grupo.',"nome":"'.$locNome.'", "cod": "'.$locId.'" }, "geometry": { "type": "'.$tipo.'", "coordinates":'.$coordGeoJson.'}}';
                }
            }
            $geoJson = $ini.implode(",",$conteudo).$fim;
            return $geoJson;
            
        }
        

}
        
?>