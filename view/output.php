<?php
  require_once("../business/indicador_business_class.php");
  require_once("../business/dados_business_class.php");
  session_start();
  $output=0;
  //tipos de saídas 0 - array, 1-excel xls, 2-csv e 3-JSON , 4 - html
  if(isset($_REQUEST["export"])){
    $output = $_REQUEST["export"];
  }else{
    $output =4 ; // saída em html
  }

  $arrLocalidades = $_SESSION['localidades'];
  $arrIndicadores = $_SESSION['indicadores'];

  //busca os dados para montagem do output
  $oDdao = new DadosBusiness();
  $tabela_dados = $oDdao->findDadosByLocsAndIndics($arrLocalidades, $arrIndicadores,$output);

  $data = date('dmY_His');
  $filename = "painel_indic_".$data;

switch($output)
{
 case "1":
	//XLS - exibe a tabela pronta em html para XLS
	header("Content-Type:  application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header ("Content-Disposition: attachment; filename=\"".$filename.".xls\"" );
	print("$tabela_dados");
	break;
    
case "2": // formato CSV
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"".$filename.".csv\"");
	print("$tabela_dados");
	break;

case "3": // formato JSON
         print($tabela_dados);
         break;

case "4": // formato Html
    header('Content-Type: text/html; charset=iso-8859-1');
    ?>

<html>
    <head>
        <title>BICIR - Painel de Indicadores</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" />

    <body>

<?php
        $titulo  = "<h3>Base de Indicadores das Comissões Intergestores Regionais (CIRs)</h3>";
        $titulo .= "<h3>PAINEL DE INDICADORES</h3><br/>";
        print($titulo);
        print('<a href="output.php?export=1"><img src="img/bt_exportar.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="output.php?export=2"><img src="img/bt_exportarcsv.gif" border="0"></a>');
?>	
<?php
	print("$tabela_dados");
?>
	<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10">10</option>
				<option value="20" selected="selected">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span style="font-family: verdana,arial;font-size: 10px; font-weight: bold">Linhas por Página</span>
		</div>
		<div id="navigation">
			<img src="img/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="img/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="img/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="img/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Mostrando Página <span id="currentpage"></span> de <span id="pagelimit"></span></div>
	</div>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
  </script>
</body>
</html>

<?php
	break;
            
}



?>