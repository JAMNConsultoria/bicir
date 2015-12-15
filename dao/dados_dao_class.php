<?php

/**
 * @author jasmil
 *
 */
class DadosDAO extends PDOConnectionFactory {
	
	private $mode = null;
	private $pdo = null;
	
	public function DadosDAO($mode) {
		
		$this->mode = $mode;
		
		$this->pdo = new PDOConnectionFactory();
		
	}
	
	/**
	 * Retorna o array de indicadores pela localidade ID (municipio ou total da CIR).
	 * 
	 */
	public function findDadosByLocId($locid,$arrIndics) {
		
		$conn = $this->pdo->getConnection($this->mode);
                $indics = implode(',',$arrIndics);
		$sql  = " SELECT localidadeId,cod_mun,nome_mun,cod_uf,nome_uf,{$indics} from tbconteudoh";
		$sql .= " WHERE localidadeId = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(1, $locid);
		$stmt->execute();
                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
	}


        
	/**
	 * Retorna o array de indicadores TOTAIS DAS CIRs pelo cod da UF.
	 * 
	 */
	public function findTotaisCirByUfId($ufId=0) {
		
		$conn = $this->pdo->getConnection($this->mode);
		$sql  =" select";
		$sql .=" grupo_socio as 'grupo',";
		$sql .=" count(*) as 'numcir',";
		$sql .=" ((count(*)/431)*100) as 'perc_tot_cir',";
		$sql .=" sum(n_muni_cir) as 'num_munics',";
		$sql .=" ((sum(n_muni_cir)/5565)*100) as perc_tot_munics,";
		$sql .=" sum(pop_total_2011) as pop2011,";
		$sql .=" ((sum(pop_total_2011)/192379287)*100) as perc_tot_pop,";
		$sql .=" avg(n_muni_cir) as 'media_mun_cir',";
		$sql .=" sum(pop_total_2011)/sum(n_muni_cir) as 'media_pop_mun',";
		$sql .=" (sum(benef11)/(sum(pop_total_2011))*100) as 'perc_benefi',";
		$sql .=" (sum(esf_pop_11)/(sum(pop_total_2011))*100) as 'perc_pop_cadast_esf',";
		$sql .=" (sum(med_tot_dez11)/sum(pop_total_2011))*1000 as 'perc_med_mil_hab',";
		$sql .=" (sum(med_sus_dez11)/sum(med_tot_dez11))*100 as 'perc_med_sus',";
		$sql .=" (sum(leit_tot_dez11)/sum(pop_total_2011))*1000 as 'perc_leito_mil_hab',";
		$sql .=" (sum(leit_sus_dez11)/sum(leit_tot_dez11))*100 as 'perc_leitos_sus'";
		$sql .=" FROM `tbconteudoh`";
		$sql .=" WHERE tipo_loc='CIR'";
                if($ufId != 0){
                    $sql .=" and cod_uf=?";
                }    
		$sql .=" GROUP BY grupo_socio";
                //echo $sql;
                $stmt = $conn->prepare($sql);
                if($ufId !=0){
                    $stmt->bindValue(1, $ufId);
                }    
		$stmt->execute();
                
                
                
                $arrIndics= array();
    	        foreach ($stmt as $row){
    		   $arrIndics[$row[0]] = array($row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14]);
		}
                
                
                foreach($arrIndics as $grupo => $arrVals){
                    for($i=0;$i<count($arrVals);$i++){
                        $arrTabela[$i][$grupo]=$arrVals[$i];
                    }
                }
                
                
                
		return $arrTabela;
                
                
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
         /**
	 * Retorna o array de indicadores pela localidade ID (municipio ou uf ou total da CIR).
         * nos formatos  0=array, 1=html, 2=csv, 3=json
	 *
	 */
	public function findDadosByLocsAndIndics($arrLocs,$arrIndics,$formato=0) {

		$conn = $this->pdo->getConnection($this->mode);
                $indics = implode(',',$arrIndics);
                $locs = implode(',',$arrLocs);

		$sql   = " SELECT localidadeId,tipo_loc,nome_uf,nome_cir,nome_mun,{$indics} ";
                $sql  .= " FROM tbconteudoh ";
		$sql  .= " WHERE localidadeId in ({$locs})";
                $sql  .= " ORDER BY nome_uf,nome_cir,nome_mun ASC";
                #echo "<b>{$sql}</b>";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
                #echo "formato=".$formato;
                $resConsulta = $stmt->fetchAll(PDO::FETCH_ASSOC);

                switch ($formato){
                    case 0: //array
                        $result=$resConsulta;
                        break;

                    case 1: // xls
                    case 4: // html
                        $oIdao = new IndicadorBusiness();
                        $arrDescFields = $oIdao->findDescIndicadoresByArrId($arrIndics);
                        $arrHeader = array('CÓDIGO','Tipo Localidade','UF','CIR','Município');
                        $arrTroca = array(-1001=>'não se aplica',-1002=>'inexistente');
                        $arrAlinhamento =array('tipo_loc','nome_uf','nome_mun','nome_cir');
                        //cabe?alho da tabela
                        $header="<thead><tr>";
                        foreach ($arrHeader as $indice => $desc){
                            $header.= "<th><h3 align='center'>&nbsp;&nbsp;{$desc}&nbsp;&nbsp;</h3></th>";
                        }
                        foreach($arrIndics as $indice => $indicadorId){
                            $header.="<th align='right'><h3 align='center'>&nbsp;{$arrDescFields[$indicadorId]}&nbsp;</h3></th>\r\n";
                        }
                        $header.="</tr></thead><tbody>";
                        //inicio do corpo da tabela
                        $tabela = '<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">';
                        $tabela .= $header;
                        
                        foreach($resConsulta as $indice => $tabelas){
                            $tabela .= "<tr>";
                             //foreach do marcio

                            foreach($tabelas as $campo => $valor){
                                if (in_array($campo, $arrAlinhamento)){
                                    $tabela .= "\t<td align='left'>";
                                }else{
                                    $tabela .= "\t<td align='right'>";
                                }
								//n?o se aplica ou n?o dispon?vel
								if($valor=='-1001' or $valor=='-1002'){
								 $valor='NA';
								}
                                if (is_numeric($valor) && stripos($valor, ".")) {
                                        if ($valor) {
                                                if (stripos($valor, "0.00") === 0) {
                                                        $tabela .= number_format($valor, 5, ',', '');
                                                }
                                                else {
                                                        $tabela .= number_format($valor, 2, ',', '');
                                                }
                                        }
                                        else {
                                                $tabela .= "-";
                                        }
                                }
                                else {
                                    if(!in_array($campo, $arrAlinhamento)){
                                        $tabela .= ($valor?number_format($valor, 0, '', ''):(!is_numeric($valor)?'-':$valor));
                                    }else{
                                        $tabela .= ($valor?$valor:(!is_numeric($valor)?'-':$valor));
                                    }
                                }

                                $tabela .= stripos($valor, "0.00")."</td>\r\n";
                                
                            }


                            $tabela .= "</tr>";
                        }
                       

                        $tabela .= "</tbody></table>";
                        $result = $tabela;
                        break;


                    case 2: // CSV
                        $oIdao = new IndicadorBusiness();
                        $arrDescFields = $oIdao->findDescIndicadoresByArrId($arrIndics);
                        $arrHeader = array('CÓDIGO','Tipo Localidade','UF','CIR','Município');
                        $arrTroca = array(-1001=>'não se aplica',-1002=>'inexistente');
                        $arrAlinhamento =array('tipo_loc','nome_uf','nome_mun','nome_cir');
                        
                        //cabe?alho da tabela
                        $headerCSV =implode(";",$arrHeader);
                        $headerCSV .=";";

                        foreach($arrIndics as $indice => $indicadorId){
                            $headerCSV.=$arrDescFields[$indicadorId].";";
                        }
                        $headerCSV .="\r\n";
                        foreach($resConsulta as $indice => $tabelas){
                            foreach($tabelas as $campo => $valor){
                                if (is_numeric($valor) && stripos($valor, ".")) {
                                        if ($valor) {
                                                if (stripos($valor, "0.00") === 0) {
                                                        $tabelaCSV .= number_format($valor, 5, ',', '.');
                                                }
                                                else {
                                                        $tabelaCSV .= number_format($valor, 2, ',', '.');
                                                }
                                        }
                                        else {
                                                $tabelaCSV .= "-";
                                        }
                                }
                                else {
                                    if(!in_array($campo, $arrAlinhamento)){
                                        $tabelaCSV .= ($valor?number_format($valor, 0, '', '.'):(!is_numeric($valor)?'-':$valor));
                                    }else{
                                        $tabelaCSV .= ($valor?$valor:(!is_numeric($valor)?'-':$valor));
                                    }
                                }

                                $tabelaCSV .= stripos($valor, "0.00").";";

                            }
                            $tabelaCSV=substr($tabelaCSV, 0, strlen($tabelaCSV)-1);//retira a ?ltimo ponte-e-virgula do registro ";"
                            $tabelaCSV.="\r\n"; //pula linha
                        }
                        $result = $headerCSV.$tabelaCSV;
                        break;

                        // fim case 2 reescrito

                    case 3: //json
                        $json = json_encode($resConsulta);
                        $result=$json;
                        break;

                }
                return $result;
	}
        
}

?>