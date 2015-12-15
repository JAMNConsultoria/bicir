<?php
require_once("../business/localidade_business_class.php");
require_once("../business/indicador_business_class.php");
require_once("../business/util_business_class.php");
session_start();
header('Content-Type: text/html; charset=iso-8859-1');

//se o botao excluir foi acionado remove do array Session
if(isset($_POST['btnRemInd'])){
     if(isset($_POST['lstIndic'])){
        foreach($_POST['lstIndic'] as $key => $value){
             if(in_array($value,$_SESSION['indicadores'])){
                  $keyRem = array_search($value,$_SESSION['indicadores']);
                  unset($_SESSION['indicadores'][$keyRem]);
             }
        }
     }
}
//se vazio volta para a página para seleção
if(empty($_SESSION['indicadores'])){
    header("location:indicadores.php");
}


//excluindo localidades da lista
//se o botao excluir foi acionado remove do array Session
if(isset($_POST['btnRemLoc'])){
     if(isset($_POST['lstLoc'])){
        foreach($_POST['lstLoc'] as $key => $value){
             if(in_array($value,$_SESSION['localidades'])){
                  $keyRem = array_search($value,$_SESSION['localidades']);
                  unset($_SESSION['localidades'][$keyRem]);
             }
        }
     }
}

//inclui localidades a session localidades
if (isset($_REQUEST['locs'])) {
    foreach($_REQUEST['locs'] as $loc){
        $_SESSION['localidades'][] = $loc;
    }
    $_SESSION['localidades'] = array_unique($_SESSION['localidades']);
}

//se vazio volta para a página para seleção
if(empty($_SESSION['localidades'])){
    header("location:localidade.php");
}


$idGrupo = $_POST['tipo'];
//armazena na sessão a seleção de localidades

?>
<?php include 'incs/cabecalho.php';?>            

        <script language="javascript">

        $(document).ready(function()     {
            //submete formulario botao Prosseguir>>>
            $('#btnEnviar').click(function() {
                $('#frmLocSel').submit();
            });

            //submete formulario e exibe a tabela
            //  $('#btnTabela').click(function() {
            //      document.location.href="output.php";
            //  });
            //botoes para adicionar localidades e indicadores

            $('#btnAddInd').click(function() {
                document.location.href ="indicadores.php";
            });

            $('#btnAddLoc').click(function() {
                document.location.href ="localidade.php";
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
                    <!--LOCALIDADES SELECIONADAS-->
                    <div id="indSelected" style="width:100%; display:table;float:left;">
                        <table cellpadding="0" cellspacing="0" border="0" width="96%" style="margin-left:15px;">
<tr><td width="80%">
<div id="textos_ind" style="color:#666;margin-left:0;margin-right:0;"> Localidades selecionadas:</div>
                        <form id="frmLocSel" name="frmLocSel" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <select name="lstLoc[]" multiple id="lstLoc" size="8" style="font-size:12px;color:#666;width:100%;background:#efefef;border:1px solid #cccccc;margin:0px;">
                            <?php
                            //popula o box com de indicadores selecionados
                                $oLdao = new LocalidadeBusiness();

                                $arrObjListLoc=$oLdao->findLocsByArrId($_SESSION['localidades']);
                                foreach($arrObjListLoc as $key => $objListLoc){
                                    echo "<option value=\"{$objListLoc->getLocalidadeId()}\">{$objListLoc->getLocalidadeNome()}</option>";
                                        //if ($oLdao->findLocById($objListLoc->getRegiaoId()) != null) {
                                        //	echo $oLdao->findLocById($objListLoc->getRegiaoId())->getLocalidadeNome() ." -->";
                                        //}
                                        //cho $objListLoc->getLocalidadeNome() ."</option>";
                                }
                            ?>
                        </select></td>
			<td valign="middle" align="center"><br />
                        <input type="button" name="btnAddLoc" id="btnAddLoc" value="Adicionar a lista" ><br /><br />
                        <input type="submit" name="btnRemLoc" id="btnRemLoc" value="Remover da lista" ></td></tr></table>
                    </form>
                  </div>
                <!-- INDICADORES SELECIONADOS -->

               <div id="indSelected" style="width:100%; display:table;float:left;margin-top:20px;">
                     <table cellpadding="0" cellspacing="0" border="0" width="96%" style="margin-left:15px;">
<tr><td width="80%">
<div id="textos_ind" style="color:#666;margin-left:0;margin-right:0;"> Indicadores selecionados:</div>
                    <form id="frmIndSel" name="frmIndSel" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
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
                        <input type="button" name="btnAddInd" id="btnAddInd" value="Adicionar a lista" ><br /><br />
                        <input type="submit" name="btnRemInd" id="btnRemInd" value="Remover da lista" ></td></tr></table>
                    </form>
               </div>
               
                <div id="botao">
                    <form method="post" action="output.php" name="frmTabela" id="frmTabela" target="_blank">
                        <input type="image" src="img/bt_tabela.gif" name="btnEnviar" id="btnTabela"><br /><br />
                    </form>
               </div> 
              </div>
                
        </div>

<?php include 'incs/rodape.php'; ?>