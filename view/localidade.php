<?php
require_once("../business/localidade_business_class.php");
require_once("../business/indicador_business_class.php");
require_once("../constants/global.php");
session_start();
header('Content-Type: text/html; charset=iso-8859-1');

//grava na sessão a lista de indicadores vindos do formulário
if (isset($_REQUEST['indicadors'])) {
    foreach($_REQUEST['indicadors'] as $indic){
        $_SESSION['indicadores'][] = $indic;
    }
    $_SESSION['indicadores'] = array_unique($_SESSION['indicadores']);
}

//se o botao excluir foi acionado remove do array Session
if(isset($_POST['btnRem'])){
     if(isset($_POST['lstIndic'])){
        foreach($_POST['lstIndic'] as $key => $value){
             if(in_array($value,$_SESSION['indicadores'])){
                  $keyRem = array_search($value,$_SESSION['indicadores']);
                  unset($_SESSION['indicadores'][$keyRem]);
                  //se vazio volta para a página para seleção
                  if(empty($_SESSION['indicadores'])){
                        header("location:index.php");
                  }
             }
        }
     }
}


$arrIndicador = ($_SESSION['indicadores']);
$strIndicador = implode(",", $arrIndicador);

$idGrupo = $_SESSION['grupo'];

//armazena na sessão a seleção de indicadores e grupos

$exibeNivelMunicipio = true;
$exibeCheckBoxCIR = true;
$exibeTudo = false;
$exibeSoUf=false;
$exibeTudoEUf=false;

switch($idGrupo) {
	case constant("GRUPO_CIR"):
		$exibeNivelMunicipio = false;
		break;
	case constant("GRUPO_MUNICIPIO"):
		$exibeCheckBoxCIR = false;
		break;
	case constant("GRUPO_CIRMUNICIPIO"):
		$exibeTudo = true;
		break;
	case constant("GRUPO_UF"): 
		$exibeSoUf = true; 
		break;
	case constant("GRUPO_UFCIRMUNICIPIO"): 
		$exibeTudoEUf = true; 
		break;
}

?>
<?php include 'incs/cabecalho.php'; ?>

 
 <script language="javascript">
        function listaLocs(loc) {
            var ds = document.getElementById(loc).style;
            if (ds.display == '') {
                	ds.display = 'none';
            } else {
                	ds.display = '';
            }
        }
        function SelAll(it) {
            var status = it.checked;
            var p = it.parentNode;
            for (i=0;i < p.childNodes.length;i++) {
                	if (p.childNodes[i].nodeName == "INPUT") {
                        	p.childNodes[i].checked = status;
                        }
            }
        }

        $(document).ready(function()     {
            //submete formulario botao Prosseguir>>>
            $('#btnEnviar2').click(function() {
				if(jQuery("input:checkbox=:checked").length == 0) {
					alert("Por favor, selecione alguma localidade.");
					return;
				}
                $('#frmLocalidades').submit();
            });

            //submete formulario botao Remover>>>
            $('#btnRem').click(function() {
                $('#frmIndSel').submit();
            });

            $('#btnAdd').click(function() {
                document.location.href ="indicadores.php?clrSession=false";
            });

			
            $('#btnVoltar').click(function() {
                document.location.href ="index.php?clrSession=false";
            });


        }); //fim ready

      </script>
            
            <div id="conteudo">
                <div id="menu">
                    <a href="index.php" class="menu">Apresenta&ccedil;&atilde;o</a><br/>
                    <a href="mapas.php" class="menu">Mapas</a><br />
                    <div id="menu_active3">Indicadores<br />por Tema</div>
                    <a href="metodologia.php" target="_blank" class="menu">Metodologia</a><br />
                    <a href="ficha.php" class="menu">Ficha T&eacute;cnica</a><br />
                </div>
                
                <div id="corpo">
                    <div id="titulo">Indicadores por Tema</div><br /><br /><br/>
		<div id="textos_ind"><b>Selecione a Localidade:</b></div>

                    <div id="divLocalidade">
<br />
                    
                    <form action="selecoes.php" method="post" id="frmLocalidades" name="frmLocalidades">
                        <input type="hidden" name="indicadors" value="<?php echo $strIndicador; ?>" />
                    <?php
                        $oLdao = new LocalidadeBusiness();
                        $arrUfs = $oLdao ->findLocsByNivelId(1);
                        $selecionar=true;
                        foreach ($arrUfs as $ufId => $obj){
							if ($exibeSoUf) {
                      				if($selecionar){
                         				echo "<input type=\"checkbox\" onClick=\"SelAll(this)\"><img src=\"img/seta.gif\">&nbsp;<i>Selecionar todas as localidades deste n&iacute;vel</i><br>";
                         				$selecionar=false;
                				    }
									echo "<input type=\"checkbox\" name=\"locs[]\" value=\"{$ufId}\"> {$obj->getLocalidadeNome()}<br/>\n";

							}
							else {

									echo "<a href=\"javascript:listaLocs('loc_{$ufId}');\"><img src=\"img/mais.png\" border=\"0\"></a>";
									if ($exibeTudoEUf) {
										echo "<input type=\"checkbox\" name=\"locs[]\" value=\"{$ufId}\">";
									}									
									echo " {$obj->getLocalidadeNome()}<br/>\n";

        							echo "<div style=\"display:none; margin-left:22px;\" id=\"loc_{$ufId}\" class=\"div1\">";

									if ($exibeCheckBoxCIR) {
	        							echo "<input type=\"checkbox\" onClick=\"SelAll(this)\"><img src=\"img/seta.gif\">&nbsp;<i>Selecionar todas as localidades deste n&iacute;vel</i><br>";
									}
        							$arrCirs = $oLdao ->findLocsByCirId($ufId);
        							foreach ($arrCirs as $cirId => $obj1) {
										if ($exibeNivelMunicipio) {
	            							echo "<a href=\"javascript:listaLocs('loc_{$cirId}');\"><img src=\"img/mais.png\" border=\"0\"></a>";
										}
										if ($exibeCheckBoxCIR) {
											echo "<input type=\"checkbox\" name=\"locs[]\" value=\"{$cirId}\">";
										}
										echo "<a class=\"indica\" href=\"javascript:listaLocs('loc_{$cirId}');\">{$obj1->getLocalidadeNome()}</a><br/>";
										if ($exibeNivelMunicipio) {
	            							echo "<div style=\"display:none; margin-left:22px;\" id=\"loc_{$cirId}\" class=\"div1\">";
		        							echo "<input type=\"checkbox\" onClick=\"SelAll(this)\"><img src=\"img/seta.gif\">&nbsp;<i>Selecionar todas as localidades deste n&iacute;vel</i><br>";
			    							$arrMuns = $oLdao->findLocsByCirId($cirId);
											$abreDiv = false;
											foreach($arrMuns as $idMunic => $objMun){
	                 							echo "<input type=\"checkbox\" name=\"locs[]\" value=\"{$objMun->getLocalidadeId()}\"";
												if (isset($_SESSION['localidades'])){
													if(array_search($objMun->getLocalidadeId(), $_SESSION['localidades']) != null) {
													   echo " checked";
													   $abreDiv = true;
												    }
												}
												echo ">{$objMun->getLocalidadeNome()}<br />";
		        							}
											if ($abreDiv) {echo "<script>document.getElementById('loc_{$cirId}').style.display = 'block';document.getElementById('loc_{$ufId}').style.display = 'block';</script>";}
	            							echo "</div>";
										}
        							}
        							echo "</div>";
							}

 				 }		
?>
        </form>
        </div>


            <div id="indSelected" style="width:100%; display:table;float:left;">
                
                <form id="frmIndSel" name="frmIndSel" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        
<table cellpadding="0" cellspacing="0" border="0" width="96%" style="margin-left:15px;">
<tr><td width="75%">
<div id="textos_ind" style="color:#666;margin-left:0;margin-right:0;"> Indicadores selecionados:</div>
<select name="lstIndic[]" multiple id="lstIndic" size="8" style="font-size:12px;color:#666;width:100%;background:#efefef;border:1px solid #cccccc;margin:0px;">
                           <?php
                            //popula o box com de indicadores selecionados
                                $oIdao = new IndicadorBusiness();
                                $arrObjListInd=$oIdao->findIndicadoresByArrId($_SESSION['indicadores']);
                                foreach($arrObjListInd as $indice => $objListInd){
                                    echo "<option value=\"{$objListInd->getIndicadorId()}\">{$objListInd->getIndicadorNome()}</option>";
                                }
                            ?>
                        </select></td>
			<td valign="middle" align="center"><br />
                        <input type="button" name="btnAdd" id="btnAdd" value="Adicionar a lista" ><br /><br />
                        <input type="submit" name="btnRem" id="btnRem" value="Remover da lista">
                        </td>
</tr></table>
               </form>
           </div>
           <br /><br />
           <div id="botao">
                 <input type="image" src="img/bt_seguir.gif" name="btnEnviar" id="btnEnviar2"> <br /><br />
           </div>
      </div><!-- fim div corpo -->

<?php include 'incs/rodape.php'; ?>

