<?php
  session_start();
  header('Content-Type: text/html; charset=iso-8859-1');
  require_once("../business/grupo_business_class.php");
  require_once("../business/indicador_business_class.php");

  $oBGrupo = new GrupoBusiness();
  $arrGrupos =$oBGrupo->findAllGrupoVars();

if (isset($_REQUEST['clrSession']) && ($_GET['clrSession'] == "true" || empty($_GET['clrSession']))) {
	unset($_SESSION['localidades']);
	unset($_SESSION['indicadores']);
     $idGrupo = 1;
     $_SESSION['grupo']=$idGrupo;
}
/*
  if(isset($_POST['grupo'])){
     unset($_SESSION['grupo']);
     $idGrupo = $_POST['grupo'];
     $_SESSION['grupo']=$idGrupo;
  }
*/
 if(isset($_POST['grupo'])){
//     unset($_SESSION);
     $idGrupo = $_POST['grupo'];
     $_SESSION['grupo']=$idGrupo;
  }
  else {
	  $idGrupo = $_SESSION['grupo'];
  }
?>
<?php include 'incs/cabecalho.php'; ?>            
            
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
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="frmGrupo" id="frmGrupo" onsubmit="return checkForm(this)">
                        <input type="hidden" name="clrSession" value="false">
                        <div id="grupo">
                            <div id="textos">Selecione o GRUPO de INDICADORES segundo os TIPOS de localidades:</div>
                            <?php
                                foreach ($arrGrupos as $idTipoGrupo => $descGrupo) {
                                    $checked = ($idGrupo==$idTipoGrupo ?' checked':'');
                                    echo "<input type=\"radio\" id=\"grupo\" name=\"grupo\" value=\"{$idTipoGrupo}\" title=\"Grupo\" {$checked} 
                                    onchange=\"this.form.clrSession.value = 'true'\"> {$descGrupo}&nbsp;&nbsp;&nbsp;&nbsp;";
                                }
                            ?>
                        </div>
                    </form>

			<br />

		    <div id="textos_ind"><b>Selecione o(s) Indicador(es) :</b></div>

                    <div id="grupoInd">
			
                        <?php include("tema.php");?>
                    </div>
                    
                <br />
		
                    
                    <br />
                    <div id="botao">
                        <input type="image" src="img/bt_seguir.gif" name="btnEnviar" id="btnEnviar"> <br /><br />
                    </div>
                </div>
                
            </div>

<?php include 'incs/rodape.php'; ?> 